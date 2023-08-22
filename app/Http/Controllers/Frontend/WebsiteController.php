<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\About;
use App\Models\AdminUser;
use App\Models\Banner;
use App\Models\Client;
use App\Models\Comment;
use App\Models\Company;
use App\Models\FAQ;
use App\Models\Feature;
use App\Models\HomeContact;
use App\Models\News;
use App\Models\NewsCategory;
use App\Models\Partner;
use App\Models\ProgressBar;
use App\Models\Project;
use App\Models\ProductType;
use App\Models\Service;
use App\Models\ServiceCategory;
use App\Models\Skill;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use function Symfony\Component\Mime\Header\all;

class WebsiteController extends Controller
{
    Public function __construct(){
    }
    public function maanIndex(){
        $clients         = Client::where('status',1)->latest()->get(); //home client section info
        $news            = News::with('userTypeBlog')->where('status',1)->latest()->take(3)->get(); //home news section info
        $banners         = Banner::where('status',1)->latest()->get(); //home banner section info
        $services        = Service::with('serviceCategory')->where('status',1)->latest()->get(); //home service section info
        $serviceTitle    = Service::where('status',1)->latest()->take(1)->get(); //home service section title
        $abouts          = About::where('status',1)->latest()->take(1)->get(); //home about section info
        $productTypes    = ProductType::with('products')->where('status',1)->latest()->get();; //portfolio type info
        $products        = Product::where('status',1)->orderBy('created_at', 'DESC')->paginate(10); //portfolio type info
        $faqs            = FAQ::where('status',1)->latest()->paginate(10);
        $partners        = Partner::where('status',1)->latest()->paginate(10);
        return view('website.pages.index',
        compact('abouts','services','clients','news','banners'
            ,'serviceTitle','productTypes','products','faqs','partners'));
    }
    public function maanProductCategorySingle($slug)
    {
        $news            = News::where('status',1)->latest()->take(3)->get(); //home news section info
        $sliders         = Banner::where('status',1)->latest()->take(1)->get(); //home banner section info
        $banners         = Banner::where('status',1)->latest()->take(1)->get(); //home banner section info
        $services        = Service::where('status',1)->latest()->get(); //home service section info
        $clients         = Client::where('status',1)->latest()->get(); //home client section info
        $serviceTitle    = Service::where('status',1)->latest()->take(1)->get(); //home service section title
        $abouts          = About::where('status',1)->latest()->take(1)->get(); //home about section info
        $subCategories   = ProductType::where('status',1)->where('slug',$slug)->get();
        $productTypes    = ProductType::where('status',1)->latest()->get();
        $faqs            = FAQ::where('status',1)->latest()->paginate(10);
        $partners        = Partner::where('status',1)->latest()->paginate(10);
        return view('website.pages.productCategorySingle',
            compact('abouts','services','clients','news','sliders','banners',
                'serviceTitle','productTypes','subCategories','faqs','partners'));
    }

    public function maanAbout(){
        $abouts         = About::where('status',1)->latest()->take(1)->get(); //about section info
        $skills         = Skill::where('status',1)->first(); //skill section info
        $bars           = ProgressBar::where('status',1)->latest()->take(5)->get(); //skill progress bar info
        return view('website.pages.about',
        compact('abouts','skills','bars'));
    }

    public function maanService(){
        $services      = Service::where('status',1)->latest()->paginate(10); //services info
        return view('website.pages.service',
        compact('services'));
    }
    public function maanFAQ(){
        $faqs      = FAQ::where('status',1)->latest()->paginate(10); //FAQs info
        return view('website.pages.index',
            compact('faqs'));
    }
    public function maanCategoryService($slug)
    {
        $services = Service::with('serviceCategory')->where('service_category_id', ServiceCategory::where('slug',$slug)->value('id'))->where('status',1)->latest()->get();//category wise services info
        return view('website.pages.category_wise_service',
            compact('services'));
    }

    public function maanNews(){
        $blogs              = News::with('newsCategory', 'userTypeBlog')->where('status',1)->latest()->take(50)->paginate(10);
        $blogCategories     = NewsCategory::with('categoryCount')->where('status',1)->latest()->get();
        $tags               = News::where('status',1)->latest()->take(3)->get(); //news tag info
        $recents            = News::where('status',1)->latest()->take(4)->get(); //news recent info
        return view('website.pages.news',
        compact('blogs','blogCategories','tags','recents'));
    }

    public function maanSearch(Request $request){
        $blogs              = News::where('status',1)->latest()->take(50)->paginate(5);
        $blogCategories     = NewsCategory::with('categoryCount')->where('status',1)->latest()->get();
        $tags               = News::where('status',1)->latest()->take(3)->get(); //news tag info
        $recents            = News::where('status',1)->latest()->take(4)->get(); //news recent info
        $serviceCategory    = ServiceCategory:: where('status',1)->latest()->get(); //service category info
        // Get the search value from the request
        $search = $request->input('search');

        // Search in the title and body columns from the posts table
        $posts = News::with('newsCategory', 'userTypeBlog')
            ->where('title', 'LIKE', "%{$search}%")
            ->orWhere('description', 'LIKE', "%{$search}%")
            ->get();

        // Return the search view with the resluts compacted
        return view('website.pages.search', compact('posts','blogs','blogCategories','tags','serviceCategory','recents'));
    }

    public function maanContact(){
        $contacts           = Company::where('status',1)->latest()->take(1)->get(); //contact info
        return view('website.pages.contact',
        compact('contacts'));
    }

    public function maanProduct(){
        $productTypes = ProductType::where('status',1)->latest()->get(); //portfolio type info
        return view('website.pages.product',
        compact('productTypes'));
    }
    public function maanProductSingle($slug){

        $subCategory    = ProductType::where('status',1)->where('slug',$slug)->get(); //portfolio, service category section
        // info

        return view('website.pages.productSingle',
        compact('subCategory'));
    }
    public function maanBlogCategorySingle($slug){
        $blogCategories     = NewsCategory::where('status',1)->where('slug',$slug)->paginate(10);
        $categories         = NewsCategory::where('status',1)->latest()->get();
        $tags               = News::where('status',1)->latest()->take(3)->get(); //news tag info
        $recents            = News::where('status',1)->latest()->take(4)->get(); //news recent info
        return view('website.pages.blogCategorySingle',
            compact('blogCategories','recents','tags','categories'));
    }

    public function maanBlogSingle($slug)
    {
        $blogs              = News::where('status',1)->where('slug',$slug)->first(); // blog to news single by id
        $tags               = News::where('status',1)->latest()->take(5)->get(); //blog single,tag section info
        $recents            = News::where('status',1)->latest()->take(4)->get(); //blog single, recent section info
        $comments           = Comment::where('news_id',$blogs->id)->where('status',1)->latest()->take(10)->get(); //blog single, comment section info by id
        $serviceCategory    = ServiceCategory::paginate(10); //blog single, service category section info
        $blogCategories     = NewsCategory::with('categoryCount')->where('status',1)->latest()->get();
        return view('website.pages.blog_single', compact('serviceCategory','recents','blogs','tags','comments','blogCategories'));
    }
    public function maanServiceSingle($slug){
        $services = Service::where('status',1)->where('slug',$slug)->first(); // service to service single by id

        $serviceCategory  = ServiceCategory::paginate(10); //service single,service category section info
        return view('website.pages.serviceSingle',
        compact('serviceCategory','services'));
    }


}
