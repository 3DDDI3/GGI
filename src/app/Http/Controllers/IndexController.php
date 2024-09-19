<?php

namespace App\Http\Controllers;

use App\Helpers\FileUpload;
use App\Helpers\Helper;
use App\Helpers\Search;
use App\Models\Content;
use App\Models\Branches;
use App\Models\Eform;
use App\Models\Files;
use App\Models\Gallery;
use App\Models\Laboratories;
use App\Models\Pages\Pages;
use App\Models\Staff;
use App\Models\Subdivisions;
use App\Models\Council;
use App\Models\Publications;
use Illuminate\Http\Request;

class IndexController extends Controller {
  private $page;

  public function __construct( \App\Contracts\Pages $pages ) {
    $this->page = $pages->detect();
  }

  public function main() {
    $page = Pages::where('page_code', 'main')->first();
    $banner_news = Content::getNewsList(false, 5);
    $board_news = Content::getNewsList(false, 3);
    $portfolio = Content::getPortfolioList(3);


    return view('pages.main', compact('page', 'banner_news', 'board_news', 'portfolio'));
  }

  public function news( Request $request ) {

    $year = $request->y ?? (int) date('Y');
    $news = Content::getNewsList(false, null, $year);
    $years = Content::getNewsYearList();
    $page = $this->page;

    return view('pages.news', compact('news', 'page', 'year', 'years'));
  }

  public function newsSingle($link) {
    $news = Content::where('type', 'news')->where('link', $link)->first();
    $page = $this->page;

    return view('pages.news_single', compact('news', 'page'));
  }

  public function arxiv_novostei( Request $request ) {

    $news = Content::where('type', 'news')->where('arxiv', 1)->get();
    $page = $this->page;

    return view('pages.arxiv_novostei', compact('news', 'page'));
  }

  public function arxiv_novosteiSingle($link) {
    $news = Content::where('type', 'news')->where('link', $link)->first();
    $page = $this->page;

    return view('pages.arxiv_novostei_single', compact('news', 'page'));
  }

  public function services() {
    $services = Content::getServicesList();
    $page = $this->page;

    return view('pages.services', compact('services', 'page'));
  }

  public function servicesSingle($link) {
    $service = Content::where('type', 'services')->where('link', $link)->first();
    $page = $this->page;

    return view('pages.services_single', compact('service', 'page'));
  }

  public function about() {
    $page = $this->page;
    $files_links = $page->getFilesLinks();

    return view('pages.about', compact('page', 'files_links'));
  }

  public function courses() {
    $page = $this->page;
    $files_links = $page->getFilesLinks();
    $courses = Content::getCoursesList();

    return view('pages.courses', compact('page', 'files_links', 'courses'));
  }

  public function contacts() {
    $page = $this->page;

    return view('pages.contacts', compact('page'));
  }

  public function coursesSingle($link) {
    $page = $this->page;
    $course = Content::where('type', 'courses')->where('link', $link)->first();

    return view('pages.courses_single', compact('page', 'course'));
  }

  public function vacancies() {
    $page = $this->page;
    $files_links = $page->getFilesLinks();
    $vacancies = Content::getVacanciesList();

    return view('pages.vacancies', compact('page', 'files_links', 'vacancies'));
  }

  public function administration() {
    $page = $this->page;
    $administration = Content::getAdministrationList();

    return view('pages.administration', compact('page', 'administration'));
  }

  public function structure() {
    $page = $this->page;
    $departments = Content::getDepartmentsList();

    return view('pages.structure', compact('page', 'departments'));
  }

  public function structureSingle( $department ) {
    $department_item = Content::where('type', 'departments')->where('link', $department)->first();

    return view('pages.structure_single', ['page' => $this->page, 'department' => $department_item]);
  }

  public function staff() {
    $page = $this->page;
    $staff = Staff::getList();
    $laboratories = Laboratories::getList();
    $subdivisions = Subdivisions::getList();

    return view('pages.staff', compact('page', 'staff', 'laboratories', 'subdivisions'));
  }
  public function branches() {
    $page = $this->page;
    $branches = Branches::getList();

    return view('pages.branches', compact('page', 'branches'));
  }

  public function publications2() {
    $page = $this->page;
    $publications = Content::getPublications2List();

    return view('pages.publications2', compact('page', 'publications'));
  }

  public function publications2Single( $publication ) {
    $publication_item = Content::where('type', 'publications2')->where('link', $publication)->first();

    return view('pages.publications2_single', ['page' => $this->page, 'publication' => $publication_item]);
  }

  public function publications() {
    $page = $this->page;
    $publications = Publications::getList();

    return view('pages.publications', compact('page', 'publications'));
  }

  public function council() {
    $page = $this->page;
    $council = Council::getList();

    foreach ($council as &$value) {
      $value->text = Helper::traitList($value->text);
    }

    return view('pages.council', compact('page', 'council'));
  }

  public function eform( Request $request ) {
    $page = $this->page;

    $data = false;
    if ($request->isMethod('post')) {



      $request->validate([

        'name1' => 'required',
        'name2' => 'required',
        'zipcode' => ['required', 'numeric'],
        'region' => 'required',
        'city' => 'required',
        'address' => 'required',
        'text' => 'required',
        'email' => 'sometimes|nullable|email:rfc,dns',
      ]);



      $data = new Eform();
      $data->fill($request->except(['_token']));
      $data->save();

      $file_data = new Files();
      $file_data->item_type = "eform";
      $file_data->item_id = $data->id;
      $file_data->path = "";
      $file_data->save();

      FileUpload::uploadFile('file', Files::class, 'path', $file_data->id, '/files/eform');

    }


    return view('pages.eform', compact('page', 'data'));
  }

  public function formStyle( $url ) {
    $page = Pages::where('url', $url)->first();
    if (!$page)
      abort(404);

    $files_links = $page->getFilesLinks();

    $files = Files::getFile('form_style');
    $form_style = [];
    foreach ($files as $key => $file) {
      $form_style[$file->item_id][] = $file;
    }
    return view('pages.formstyle', compact('page', 'files_links', 'form_style'));
  }



  public function magazine( Request $request ) {
    $page = $this->page;

    // if($page->id === 35){
    //   $page->text = Helper::TablePrettier($page->text);
    // }

    $departments = Content::where([['type', '=', 'magazine'],['hide','=','0']])->orderBy('rating', 'desc')->get();


    foreach ($departments as $key => $department) {
      $department->text = Helper::TablePrettier($department->text);
      $department->text_en = Helper::TablePrettier($department->text_en);

      $department->text = Helper::traitList($department->text);
      $department->text_en = Helper::traitList($department->text_en);
    }

    if (!$page)
      abort(404);

    $files_links = $page->getFilesLinks();

    return view('pages.magazine', compact('page', 'files_links', 'departments'));
  }
  public function aspirantura( Request $request ) {
    $page = $this->page;

    $departments = Content::where([['type', '=', 'graduate'],['hide','=','0']])->orderBy('rating', 'desc')->get();

    foreach ($departments as $key => &$department) {
      $department->text = Helper::TablePrettier($department->text);
      $department->text_en = Helper::TablePrettier($department->text_en);

      $department->text = Helper::traitList($department->text);
      $department->text_en = Helper::traitList($department->text_en);
      
      $department->gallery = Gallery::getGallery('graduate_asp' , $department->id);
    }

    if (!$page)
      abort(404);

    $files_links = $page->getFilesLinks();
  
    return view('pages.aspirantura', compact('page', 'files_links', 'departments'));
  }

  public function search(Request $request)
  {
      $page = $this->page;
      $query = $request->input('query') ?? '';

      return view('pages.search', compact('page', 'query'));
  }
  


  public function page( $url ) {
    $page = Pages::where('url', $url)->first();

    if (!$page)
      abort(404);

    if ($page->id === 20) {
      return $this->formStyle($url);
    }
    if ($page->id === 35) {
      $page->text = Helper::TablePrettier($page->text);
      $page->text = Helper::traitList($page->text);

    }



    $files_links = $page->getFilesLinks();

    return view('pages.page', compact('page', 'files_links'));
  }
}
