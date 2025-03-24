<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Blog;
use Illuminate\Support\Facades\Storage;

class BlogController extends Controller
{
    public function index()
    {
        $blogs = Blog::latest()->paginate(10);
        return view('admin.blogs.index', compact('blogs'));
    }

    public function create()
    {
        return view('admin.blogs.create');
    }

    public function store(Request $request)
    {
        // Validate request
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        // Handle image upload if exists
        if ($request->hasFile('image')) {
            // Store image in the 'public' disk in 'blogs' directory
            $validated['image'] = $request->file('image')->store('blogs', 'public');
        }

        // Create new blog post
        Blog::create($validated);

        return redirect()->route('admin.blogs')->with('success', 'Blog created successfully!');
    }

    public function edit($id)
    {
        $blog = Blog::findOrFail($id);
        return view('admin.blogs.edit', compact('blog'));
    }

    public function update(Request $request, $id)
    {
        $validatedData = $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $blog = Blog::findOrFail($id);
        $blog->title = $validatedData['title'];
        $blog->content = $validatedData['content'];

        // Handle the image upload if a new image is provided
        if ($request->hasFile('image')) {
            // Delete the old image if it exists
            if ($blog->image) {
                Storage::delete('public/' . $blog->image);
            }

            // Upload new image
            $path = $request->file('image')->store('blogs', 'public');
            $blog->image = $path;
        }

        $blog->save();

        return redirect()->route('admin.blogs')->with('success', 'Blog updated successfully');
    }

    public function destroy($id)
    {
        // Fetch the blog
        $blog = Blog::findOrFail($id);

        // Delete associated image if exists
        if ($blog->image) {
            Storage::disk('public')->delete($blog->image); // Delete old image
        }

        // Delete the blog post
        $blog->delete();

        return redirect()->route('admin.blogs')->with('success', 'Blog deleted successfully!');
    }

}
