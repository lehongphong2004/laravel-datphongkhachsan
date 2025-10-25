<?php
namespace App\Http\Controllers;

use App\Models\BlogDuLich;
use Illuminate\Http\Request;

class BlogDuLichController extends Controller
{
    public function index()
    {
        $blogs = BlogDuLich::latest()->paginate(6);
        return view('blog.index', compact('blogs'));
    }

    public function show($id)
    {
        $blog = BlogDuLich::findOrFail($id);
        return view('blog.show', compact('blog'));
    }
    public function edit($id)
    {
    $blog = \App\Models\BlogDuLich::findOrFail($id);
    return view('admin.blog.edit', compact('blog'));
    }
    public function create()
    {
    return view('admin.blog.create');
    }
public function store(Request $request)
{
    $request->validate([
        'tieu_de' => 'required|string|max:255',
        'tac_gia' => 'required|string|max:100',
        'noi_dung' => 'required|string',
    ]);

    \App\Models\BlogDuLich::create([
        'tieu_de' => $request->tieu_de,
        'tac_gia' => $request->tac_gia,
        'noi_dung' => $request->noi_dung,
    ]);

    return redirect()->route('admin.blog.index')->with('success', 'Thêm bài viết thành công!');
}

}
?>
