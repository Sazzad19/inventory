<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Artisan;
use Log;
use Storage;
USE Carbon\Carbon;
class BackupController extends Controller
{

	   public function index()
    {
          $disk = Storage::disk(config('laravel-backup.backup.destination.filesystems')[0]);

        $files = $disk->files(config('laravel-backup.backup.name'));
        $backups = [];
        // make an array of backup files, with their filesize and creation date
        foreach ($files as $k => $f) {
            // only take the zip files into account
            if (substr($f, -4) == '.zip' && $disk->exists($f)) {
                $backups[] = [
                    'file_path' => $f,
                    'file_name' => str_replace(config('laravel-backup.backup.name') . '/', '', $f),
                    'file_size' =>$this->convert_filesize($disk->size($f)),
                    'last_modified' =>$this->getDate($disk->lastModified($f)),
                ];
            }
        }
        // reverse the backups, so the newest one would be on top
        $backups = array_reverse($backups);

         return view("backend.backup.index")->with(compact('backups'));



          /* $disk = Storage::disk('local');

        $files = $disk->files();
        $backups = [];
        // make an array of backup files, with their filesize and creation date
        foreach ($files as $k => $f) {
            // only take the zip files into account
            if (substr($f, -4) == '.zip' && $disk->exists($f)) {
                $backups[] = [
                    'file_path' => $f,
                    'file_name' =>$f,//['filename'], //str_replace(config('backup.name') . '/', '', $f),
                    'file_size' =>$this->convert_filesize($disk->size($f)),
                    'last_modified' => $disk->lastModified($f),
                ];
            }
        }
        // reverse the backups, so the newest one would be on top
        $backups = array_reverse($backups);

       return view("backend.backup.index")->with(compact('backups'));
        //dump( $backups);*/
       
      
    }
    
 public function create()
    {
        try {
        	ini_set('max_execution_time', 3000);
            // start the backup process
            Artisan::call('backup:run',['--only-db' => true]);
            $output = Artisan::output();
            // log the results
            Log::info("Backpack\BackupManager -- new backup started from admin interface \r\n" . $output);
            // return the results as a response to the ajax call
            //Alert::success('New backup created');
            return redirect()->back();
        } catch (Exception $e) {
            Flash::error($e->getMessage()); 
            return redirect()->back();
        }
    }

  function convert_filesize($bytes, $decimals = 2){
    $size = array('B','kB','MB','GB','TB','PB','EB','ZB','YB');
    $factor = floor((strlen($bytes) - 1) / 3);
    return sprintf("%.{$decimals}f", $bytes / pow(1024, $factor)) . @$size[$factor];
}
function getDate($date){
  return  Carbon::createfromTimeStamp($date)->formatlocalized('%d %B %Y %H:%M');


}

 public function download($file_name)
    {

     ob_end_clean();
        $file = config('laravel-backup.backup.name') . '/' . $file_name;
        $disk = Storage::disk(config('laravel-backup.backup.destination.filesystems')[0]);
        if ($disk->exists($file)) {
            $fs = Storage::disk(config('laravel-backup.backup.destination.filesystems')[0])->getDriver();
            $stream = $fs->readStream($file);

            return \Response::stream(function () use ($stream) {
                fpassthru($stream);
            }, 200, [
                "Content-Type" => $fs->getMimetype($file),
                "Content-Length" => $fs->getSize($file),
                "Content-disposition" => "attachment; filename=\"" . basename($file) . "\"",
            ]);
        } else {
            abort(404, "The backup file doesn't exist.");
        }
    	
    }

  public function delete($file_name)
    {
        $disk = Storage::disk(config('laravel-backup.backup.destination.filesystems')[0]);
        if ($disk->exists(config('laravel-backup.backup.name') . '/' . $file_name)) {
            $disk->delete(config('laravel-backup.backup.name') . '/' . $file_name);
            return redirect()->route('database.backup');
        } else {
             return redirect()->route('database.backup');

            //abort(404, "The backup file doesn't exist.");
        }
    }

     /*   public function delete($file_name)
    {
        $disk = Storage::disk('local');
        if ($disk->exists($file_name)) {
           if( $disk->delete($file_name)){

            return redirect()->route('database.backup')->with('success_message', 'Deleted Successfully');
        }
        else{

             return redirect()->route('database.backup')->with('error_message', 'Failed to Delete');
        }
        } else {
            return redirect()->route('database.backup')->with('error_message', 'File Not Exist');
    }
}*/
    
}
