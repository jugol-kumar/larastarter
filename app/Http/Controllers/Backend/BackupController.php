<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use http\Env\Response;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Storage;

class BackupController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        Gate::authorize('app.Backups.index');
        $disk = Storage::disk(config('backup.backup.destination.disks')[0]);
        $files = $disk->files(config('backup.backup.name'));

        $backups = [];
        // make an array of backup files, with there filesize and date
        foreach ($files as $key=>$file){
            //only take the zip files
            if (substr($file, -4) == '.zip' && $disk->exists($file)){
                $file_name = str_replace(config('backup.backup.name'). '/','', $file);
                $backups[] = [
                  'file_path'  => $file,
                  'file_name'  => $file_name,
                  'file_size'  => $this->bytesToHuman($disk->size($file)),
                  'created_at' => Carbon::parse($disk->lastModified($file))->diffForHumans(),
                  'download_link' => action([ BackupController::class, 'download'], [$file_name])
                ];
            }
        }
        //reverse the backups, so the newest one would be on top
        $backups = array_reverse($backups);

        return view('backend.backups.index',compact('backups'));

    }


    private function bytesToHuman($bytes){
        $units = ['B', 'KiB', 'MiB', 'GiB', 'TiB', 'PiB'];

        for ($i = 0; $bytes > 1024; $i++) {
            $bytes /= 1024;
        }
        return round($bytes, 2). ' '.$units[$i];
    }




    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        Gate::authorize('app.Backups.create');
        Artisan::call('backup:run');
        notify()->success("Backup Create Successfull","Success");
        return back();

    }

    public function download($file_Name){
        Gate::authorize('app.Backups.download');

        $file = config('backup.backup.name'). '/' . $file_Name;
        $disk = Storage::disk(config('backup.backup.destination.disks')[0]);
        if ($disk->exists($file)){
            $fs = Storage::disk(config('backup.backup.destination.disks')[0])->getDriver();
            $stream = $fs->readStream($file);
            return \Response::stream(function () use ($stream){
               fpassthru($stream);
            }, 200, [
                "Content-Type"   => $fs->getMimetype($file),
                "Content-Length" => $fs->getSize($file),
                "Content-disposition" => "attachment; filename= \"". basename($file). "\"",
            ]);
        }

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($file_name)
    {
        Gate::authorize('app.Backups.destroy');
        $disk = Storage::disk(config('backup.backup.destination.disks')[0]);
        if ($disk->exists(config('backup.backup.name').'/'.$file_name)){
            $disk->delete(config('backup.backup.name').'/'.$file_name);
        }
        notify()->success("Backup Delete Successfull","Success");
        return back();
    }

    public function clean(){
        Gate::authorize('app.Backups.destroy');
        Artisan::call('backup:clean');

        notify()->success("Old All Backup Deleted Successfull","Success");
        return back();

    }





}
