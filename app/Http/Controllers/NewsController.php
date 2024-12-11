<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\News;
use Illuminate\Support\Facades\Storage;

class NewsController extends Controller
{
    public function index()
{
    if (request()->is('gerir-noticias')) {
        $noticias = News::orderBy('created_at', 'desc')->get();
        return view('gerir-noticias', ['noticias' => $noticias]);
    }
    
    $noticias = News::orderBy('created_at', 'desc')->get();
    return view('noticias', ['noticias' => $noticias]);
}

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|max:255',
            'content' => 'required',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,webp|max:5120'
        ]);

        try {
            if ($request->hasFile('image')) {
                $image = $request->file('image');
                $path = $image->store('news', 'public');

                News::create([
                    'title' => $request->title,
                    'content' => $request->content,
                    'image' => $path
                ]);

                return redirect()->back()->with('success', 'Notícia criada com sucesso!');
            }
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Erro ao salvar a imagem: ' . $e->getMessage());
        }
    }

    public function update(Request $request, News $noticia)
    {
        $request->validate([
            'title' => 'required|max:255',
            'content' => 'required',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:5120'
        ]);

        try {
            if ($request->hasFile('image')) {
                // Apaga a imagem antiga
                if ($noticia->image) {
                    Storage::disk('public')->delete($noticia->image);
                }
                
                // Salva a nova imagem
                $path = $request->file('image')->store('news', 'public');
                $noticia->image = $path;
            }

            $noticia->title = $request->title;
            $noticia->content = $request->content;
            $noticia->save();

            return redirect()->back()->with('success', 'Notícia atualizada com sucesso!');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Erro ao atualizar a notícia: ' . $e->getMessage());
        }
    }

    public function destroy(News $noticia)
    {
        try {
            if ($noticia->image) {
                Storage::disk('public')->delete($noticia->image);
            }
            
            $noticia->delete();
            return redirect()->back()->with('success', 'Notícia excluída com sucesso!');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Erro ao excluir a notícia: ' . $e->getMessage());
        }
    }

    public function show($slug)
    {   
        $noticia= News::where('slug', $slug)->firstOrFail();
        return view('noticia-detalhe', compact('noticia'));
    }
}
