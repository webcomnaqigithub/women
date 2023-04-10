<?php

namespace App\Http\Controllers\Front\Marketplace;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ShoppingController extends Controller
{
    public function ProductShopping(Request $request)
    {
        $sub_categories = \Aimeos\MShop::create( app('aimeos.context')->get(), 'catalog' )->getTree(2)->getChildren();
        $attributes = \Aimeos\Controller\Frontend::create( app('aimeos.context')->get(), 'attribute' )
                        ->uses( ['product'] )->type( 'size' )->compare( '!=', 'attribute.type', ['date', 'price', 'text'] )
                        ->sort( '-position' )->slice( 0, 10000 )->search();

// -------------------------------------------- SEARCHING FILTER -------------------------------------------------
        $productManager = \Aimeos\MShop::create( app('aimeos.context')->get(), 'index' ) ;
        $search = $productManager->filter( true )->slice( 0, 10000 );
        $expression = array();
        if($request->attributeId !== null){
            $attribute_search = $search->compare( '==', 'index.attribute.id', $request->attributeId );
            array_push($expression, $attribute_search);
        }
        if($request->l_price !== null){
            $l_price_search = $search->compare( '>=', $search->make( 'index.price:value', [app('aimeos.context')->get()->locale()->getCurrencyId()]  ), $request->l_price );
            array_push($expression, $l_price_search);
        }
        if($request->h_price !== null){
            $h_price_search = $search->compare( '<=', $search->make( 'index.price:value', [app('aimeos.context')->get()->locale()->getCurrencyId()]  ), $request->h_price );
            array_push($expression, $h_price_search);
        }
        if($request->rating !== null){
            $rating_search = $search->compare( '==', 'product.rating', 4 );
            array_push($expression, $rating_search);
        }
        if($request->categoryId !== null){
            $category_search = $search->compare( '==', 'index.catalog.id', $request->categoryId);
            array_push($expression, $category_search);
        }
        if($request->sk !== null){
            $text_search = $search->compare( '~=', $search->make( 'index.text:name', [app()->getLocale()]  ), $request->sk );
            array_push($expression, $text_search);
        }
        $search->setConditions( $search->combine( '&&', $expression ) );
        if($request->f_sort == 'ctime'){
            $search->setSortations( [$search->sort( '-', 'product.ctime' )] );
        }
        if($request->f_sort == 'rating'){
            $search->setSortations( [$search->sort( '+', 'product.rating' )] );
        }
        if($request->f_sort == 'name'){
            $search->setSortations( [$search->sort( '+', 'product.label' )] );
        }
        $productItems = $productManager->search($search, ['media', 'text', 'price', 'catalog']);

        return view('front.marketplace.product_shopping', compact('sub_categories', 'attributes', 'productItems', 'request'));
    }

    public function CategoryShopping(Request $request, $code)
    {
        $cat = DB::table('mshop_catalog')->where('code', $request->segment(4))->first();
        $cat_list = DB::table('mshop_catalog')->where('parentid', $cat->parentid)->get();

        $sub_categories = \Aimeos\MShop::create( app('aimeos.context')->get(), 'catalog' )->getTree(2)->getChildren();
        $attributes = \Aimeos\Controller\Frontend::create( app('aimeos.context')->get(), 'attribute' )
                        ->uses( ['product'] )->type( 'size' )->compare( '!=', 'attribute.type', ['date', 'price', 'text'] )
                        ->sort( 'position' )->slice( 0, 10000 )->search();

// -------------------------------------------- SEARCHING FILTER -------------------------------------------------
        $productManager = \Aimeos\MShop::create( app('aimeos.context')->get(), 'index' ) ;
        $search = $productManager->filter( true )->slice( 0, 10000 );
        $expression = array();
        if($request->attributeId !== null){
            $attribute_search = $search->compare( '==', 'index.attribute.id', $request->attributeId );
            array_push($expression, $attribute_search);
        }
        if($request->l_price !== null){
            $l_price_search = $search->compare( '>=', $search->make( 'index.price:value', [app('aimeos.context')->get()->locale()->getCurrencyId()]  ), $request->l_price );
            array_push($expression, $l_price_search);
        }
        if($request->h_price !== null){
            $h_price_search = $search->compare( '<=', $search->make( 'index.price:value', [app('aimeos.context')->get()->locale()->getCurrencyId()]  ), $request->h_price );
            array_push($expression, $h_price_search);
        }
        if($request->rating !== null){
            $rating_search = $search->compare( '==', 'product.rating', $request->rating );
            array_push($expression, $rating_search);
        }
        if($cat->id){
            $category_search = $search->compare( '==', 'index.catalog.id',$cat->id);
            array_push($expression, $category_search);
        }
        if($request->sk !== null){
            $text_search = $search->compare( '~=', $search->make( 'index.text:name', [app()->getLocale()]  ), $request->sk );
            array_push($expression, $text_search);
        }
        $search->setConditions( $search->combine( '&&', $expression ) );
        if($request->f_sort == 'ctime'){
            $search->setSortations( [$search->sort( '-', 'product.ctime' )] );
        }
        if($request->f_sort == 'rating'){
            $search->setSortations( [$search->sort( '+', 'product.rating' )] );
        }
        if($request->f_sort == 'name'){
            $search->setSortations( [$search->sort( '+', 'product.label' )] );
        }
        $productItems = $productManager->search($search, ['media', 'text', 'price', 'catalog']);

        return view('front.marketplace.category_shopping', compact('sub_categories', 'attributes', 'productItems', 'request', 'cat', 'cat_list'));
    }

    public function CategoryList(Request $request)
    {   
        $subcategories = [];
        $cat = DB::table('mshop_catalog')->where('id', $request->segment(3))->first();
        $cat_list = DB::table('mshop_catalog')->where('parentid', $request->segment(3))->get();
         foreach($cat_list as $item){
            $subcategories[] = \Aimeos\Controller\Frontend::create( app( 'aimeos.context' )->get(), 'catalog' )->uses(['media'])->get($item->id);
         }

         return view('front.marketplace.category_List', compact('subcategories', 'cat'));
    }
}
