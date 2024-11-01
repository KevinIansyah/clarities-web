<?php

namespace App\Http\Controllers;

use App\Models\Blog;
use App\Models\Fasilitas;
use App\Models\KalenderAkademik;
use App\Models\KerjaSama;
use App\Models\KurikulumLab;
use App\Models\ModulPraktikum;
use App\Models\Pelatihan;
use App\Models\Pengelola;
use App\Models\Sop;
use App\Models\StrukturOrganisasi;
use App\Models\TemporaryFile;
use App\Models\TemporaryImage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Storage;

class FilePondController extends Controller
{
    public function uploadImage(Request $request)
    {
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $fileName = $image->getClientOriginalName();
            $folder = uniqid('post', true);
            $image->storeAs('post/tmp-filepond-image/' . $folder, $fileName);
            TemporaryImage::create([
                'folder' => $folder,
                'file' => $fileName,
            ]);
            Session::push('image-law-app', $folder);
            return $folder;
        }
        return '';
    }

    public function cancelImage()
    {
        $folder = request()->getContent();
        $image = Session::get('image-law-app', []);

        $index = array_search($folder, $image);

        if ($index !== false) {
            unset($image[$index]);
            Session::put('image-law-app', $image);
        }

        $tmpFile = TemporaryImage::where('folder', request()->getContent())->first();
        if ($tmpFile) {
            Storage::deleteDirectory('post/tmp-filepond-image/' . $tmpFile->folder);
            $tmpFile->delete();
            return response('');
        }
    }

    public function uploadFile(Request $request)
    {
        if ($request->hasFile('file')) {
            $file = $request->file('file');
            $fileName = $file->getClientOriginalName();
            $folder = uniqid('post', true);
            $file->storeAs('post/tmp-filepond-file/' . $folder, $fileName);
            TemporaryFile::create([
                'folder' => $folder,
                'file' => $fileName,
            ]);
            Session::push('file-law-app', $folder);

            return $folder;
        }
        return '';
    }

    public function cancelFile()
    {
        $folder = request()->getContent();
        $file = Session::get('file-law-app', []);

        $index = array_search($folder, $file);

        if ($index !== false) {
            unset($file[$index]);
            Session::put('file-law-app', $file);
        }

        $tmpFile = TemporaryFile::where('folder', request()->getContent())->first();
        if ($tmpFile) {
            Storage::deleteDirectory('post/tmp-filepond-file/' . $tmpFile->folder);
            $tmpFile->delete();
            return response('');
        }
    }

    public function removeImageBlog(Request $request)
    {
        $data = $request->json()->all();
        $source = $data['source'] ?? null;

        if (!$source) {
            return response()->json(['error' => 'No source provided'], 422);
        }

        $path = parse_url($source, PHP_URL_PATH);
        $parts = explode('/', $path);
        $folder = $parts[count($parts) - 2];

        $tmpFile = Blog::where('image', 'like', '%' . $folder . '/%')->first();
        if ($tmpFile) {
            Storage::deleteDirectory('filepond-image/' . $folder);
            $tmpFile->image = null;
            $tmpFile->save();
            return response()->json(['success' => true]);
        }

        return response()->json(['error' => 'File not found'], 404);
    }

    public function removeImagePengelola(Request $request)
    {
        $data = $request->json()->all();
        $source = $data['source'] ?? null;

        if (!$source) {
            return response()->json(['error' => 'No source provided'], 422);
        }

        $path = parse_url($source, PHP_URL_PATH);
        $parts = explode('/', $path);
        $folder = $parts[count($parts) - 2];

        $tmpFile = Pengelola::where('image', 'like', '%' . $folder . '/%')->first();
        if ($tmpFile) {
            Storage::deleteDirectory('filepond-image/' . $folder);
            $tmpFile->image = null;
            $tmpFile->save();
            return response()->json(['success' => true]);
        }

        return response()->json(['error' => 'File not found'], 404);
    }

    public function removeImageStrukturOrganisasi(Request $request)
    {
        $data = $request->json()->all();
        $source = $data['source'] ?? null;

        if (!$source) {
            return response()->json(['error' => 'No source provided'], 422);
        }

        $path = parse_url($source, PHP_URL_PATH);
        $parts = explode('/', $path);
        $folder = $parts[count($parts) - 2];

        $tmpFile = StrukturOrganisasi::where('image', 'like', '%' . $folder . '/%')->first();
        if ($tmpFile) {
            Storage::deleteDirectory('filepond-image/' . $folder);
            $tmpFile->image = null;
            $tmpFile->save();
            return response()->json(['success' => true]);
        }

        return response()->json(['error' => 'File not found'], 404);
    }

    public function removeImageKerjaSama(Request $request)
    {
        $data = $request->json()->all();
        $source = $data['source'] ?? null;

        if (!$source) {
            return response()->json(['error' => 'No source provided'], 422);
        }

        $path = parse_url($source, PHP_URL_PATH);
        $parts = explode('/', $path);
        $folder = $parts[count($parts) - 2];

        $tmpFile = KerjaSama::where('image', 'like', '%' . $folder . '/%')->first();
        if ($tmpFile) {
            Storage::deleteDirectory('filepond-image/' . $folder);
            $tmpFile->image = null;
            $tmpFile->save();
            return response()->json(['success' => true]);
        }

        return response()->json(['error' => 'File not found'], 404);
    }

    public function removeImagePelatihan(Request $request)
    {
        $data = $request->json()->all();
        $source = $data['source'] ?? null;

        if (!$source) {
            return response()->json(['error' => 'No source provided'], 422);
        }

        $path = parse_url($source, PHP_URL_PATH);
        $parts = explode('/', $path);
        $folder = $parts[count($parts) - 2];

        $tmpFile = Pelatihan::where('image', 'like', '%' . $folder . '/%')->first();
        if ($tmpFile) {
            Storage::deleteDirectory('filepond-image/' . $folder);
            $tmpFile->image = null;
            $tmpFile->save();
            return response()->json(['success' => true]);
        }

        return response()->json(['error' => 'File not found'], 404);
    }

    public function removeImageSop(Request $request)
    {
        $data = $request->json()->all();
        $source = $data['source'] ?? null;

        if (!$source) {
            return response()->json(['error' => 'No source provided'], 422);
        }

        $path = parse_url($source, PHP_URL_PATH);
        $parts = explode('/', $path);
        $folder = $parts[count($parts) - 2];

        $tmpFile = Sop::where('image', 'like', '%' . $folder . '/%')->first();
        if ($tmpFile) {
            Storage::deleteDirectory('filepond-image/' . $folder);
            $tmpFile->image = null;
            $tmpFile->save();
            return response()->json(['success' => true]);
        }

        return response()->json(['error' => 'File not found'], 404);
    }

    public function removeImageKalenderAkademik(Request $request)
    {
        $data = $request->json()->all();
        $source = $data['source'] ?? null;

        if (!$source) {
            return response()->json(['error' => 'No source provided'], 422);
        }

        $path = parse_url($source, PHP_URL_PATH);
        $parts = explode('/', $path);
        $folder = $parts[count($parts) - 2];

        $tmpFile = KalenderAkademik::where('image', 'like', '%' . $folder . '/%')->first();
        if ($tmpFile) {
            Storage::deleteDirectory('filepond-image/' . $folder);
            $tmpFile->image = null;
            $tmpFile->save();
            return response()->json(['success' => true]);
        }

        return response()->json(['error' => 'File not found'], 404);
    }

    public function removeImageFasilitas(Request $request)
    {
        $data = $request->json()->all();
        $source = $data['source'] ?? null;

        if (!$source) {
            return response()->json(['error' => 'No source provided'], 422);
        }

        $path = parse_url($source, PHP_URL_PATH);
        $parts = explode('/', $path);
        $folder = $parts[count($parts) - 2];

        $tmpFile = Fasilitas::where('image', 'like', '%' . $folder . '/%')->first();
        if ($tmpFile) {
            Storage::deleteDirectory('filepond-image/' . $folder);
            $tmpFile->image = null;
            $tmpFile->save();
            return response()->json(['success' => true]);
        }

        return response()->json(['error' => 'File not found'], 404);
    }


    public function removeFileKalenderAkademik(Request $request)
    {
        $data = $request->json()->all();
        $source = $data['source'] ?? null;

        if (!$source) {
            return response()->json(['error' => 'No source provided'], 422);
        }

        $path = parse_url($source, PHP_URL_PATH);
        $parts = explode('/', $path);
        $folder = $parts[count($parts) - 2];

        $tmp_file = KalenderAkademik::where('file', 'like', '%' . $folder . '/%')->first();
        if ($tmp_file) {
            Storage::deleteDirectory('filepond-file/' . $folder);
            $tmp_file->file = null;
            $tmp_file->save();
            return response()->json(['success' => true]);
        }

        return response()->json(['error' => 'File not found'], 404);
    }

    public function removeFileModulPraktikum(Request $request)
    {
        $data = $request->json()->all();
        $source = $data['source'] ?? null;

        if (!$source) {
            return response()->json(['error' => 'No source provided'], 422);
        }

        $path = parse_url($source, PHP_URL_PATH);
        $parts = explode('/', $path);
        $folder = $parts[count($parts) - 2];

        $tmp_file = ModulPraktikum::where('file', 'like', '%' . $folder . '/%')->first();
        if ($tmp_file) {
            Storage::deleteDirectory('filepond-file/' . $folder);
            $tmp_file->file = null;
            $tmp_file->save();
            return response()->json(['success' => true]);
        }

        return response()->json(['error' => 'File not found'], 404);
    }

    public function removeFileSop(Request $request)
    {
        $data = $request->json()->all();
        $source = $data['source'] ?? null;

        if (!$source) {
            return response()->json(['error' => 'No source provided'], 422);
        }

        $path = parse_url($source, PHP_URL_PATH);
        $parts = explode('/', $path);
        $folder = $parts[count($parts) - 2];

        $tmp_file = Sop::where('file', 'like', '%' . $folder . '/%')->first();
        if ($tmp_file) {
            Storage::deleteDirectory('filepond-file/' . $folder);
            $tmp_file->file = null;
            $tmp_file->save();
            return response()->json(['success' => true]);
        }

        return response()->json(['error' => 'File not found'], 404);
    }

    public function removeFileKurikulumLab(Request $request)
    {
        $data = $request->json()->all();
        $source = $data['source'] ?? null;

        if (!$source) {
            return response()->json(['error' => 'No source provided'], 422);
        }

        $path = parse_url($source, PHP_URL_PATH);
        $parts = explode('/', $path);
        $folder = $parts[count($parts) - 2];

        $tmp_file = KurikulumLab::where('file', 'like', '%' . $folder . '/%')->first();
        if ($tmp_file) {
            Storage::deleteDirectory('filepond-file/' . $folder);
            $tmp_file->file = null;
            $tmp_file->save();
            return response()->json(['success' => true]);
        }

        return response()->json(['error' => 'File not found'], 404);
    }


    public function upload(Request $request)
    {
        if ($request->hasFile('upload')) {
            $fileName = $request->file('upload')->getClientOriginalName();
            $folder = uniqid('post_', true);
            $path = $folder . '/' . time() . '_' . $fileName;
            $filePath = $request->file('upload')->storeAs('public/media', $path);
            $url = Storage::url($filePath);

            return response()->json(['fileName' => $path, 'uploaded' => 1, 'url' => $url]);
        }

        return response()->json(['uploaded' => 0, 'error' => ['message' => 'No file uploaded']]);
    }
}
