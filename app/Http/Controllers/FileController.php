<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Calon;
use App\FileGdrive;

use Hypweb\Flysystem\GoogleDrive\GoogleDriveAdapter;

class FileController extends Controller
{
    public function index()
    {
    }

    public function upload($fileNya, $jenis, $id)
    {
        try {
            $client = new \Google_Client;
            $client->setClientId(env('GOOGLE_DRIVE_CLIENT_ID'));
            $client->setClientSecret(env('GOOGLE_DRIVE_CLIENT_SECRET'));
            $client->refreshToken(env('GOOGLE_DRIVE_REFRESH_TOKEN'));

            $service =  new \Google_Service_Drive($client);
            $adapter = new GoogleDriveAdapter($service, env('GOOGLE_DRIVE_FOLDER_ID'));

            $fileName = "";
            if ($jenis == 'pp') {
                $fileName = "Photo-" . $id;
            }

            $extension = $fileNya->getClientOriginalExtension();
            $folderId = folderID();

            $fileMetadata = new \Google_Service_Drive_DriveFile(array(
                'name' => $fileName,
                'parents' => array($folderId)
            ));

            $file = file_get_contents($fileNya);

            $fileId = $service->files->create($fileMetadata, array(
                'data' => $file,
                'mimeType' => $fileNya->getClientMimeType(),
                'uploadType' => 'multipart',
                'fields' => 'id'
            ));

            FileGdrive::create([
                'jenisfile' => 'profile',
                'folderId' => $folderId,
                'fileName' => $fileName,
                'fileId' => $fileId->id,
                'extension' => $extension
            ]);

            return 'OKE';
        } catch (RequestException $e) {
            return $e;
        }
    }

    public function show($id)
    {
        $calon = Calon::where('id', $id)->where('user_id', auth()->user()->id)->first();
        $unit_id = Gelombang::where('id', $calon->gel_id)->first();
        $unit = Unit::where('id', $unit_id->unit_id)->first();
        $tingkat = SchoolCategory::where('id', $unit->cat_id)->first()->name;
        return view('uniform.create', compact('tingkat', 'calon'));
    }

    public function update(Request $request, $id)
    {
        // dd($request->atas);
        CalonSeragam::updateOrCreate(
            ['calon_id' => $id],
            [
                'atas' => $request->atas,
                'bawah' => $request->bawah,
                'lain' => "-"
            ]
        );
        // $calon = Calon::where('id', $request->calon)->first();
        return redirect()->route('home');
    }
}
