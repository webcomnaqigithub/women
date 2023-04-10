<?php

namespace App\Http\Controllers\Front\Marketplace;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class OurnewsController extends Controller
{
    public function index(Request $request)
    {
        $sub_categories = \Aimeos\MShop::create( app('aimeos.context')->get(), 'catalog' )->getTree(2)->getChildren();
        $attributes = \Aimeos\Controller\Frontend::create( app('aimeos.context')->get(), 'attribute' )
                        ->uses( ['product'] )->type( 'size' )->compare( '!=', 'attribute.type', ['date', 'price', 'text'] )
                        ->sort( '-position' )->slice( 0, 10000 )->search();

// -------------------------------------------- SEARCHING FILTER -------------------------------------------------
        $productManager = \Aimeos\MShop::create( app('aimeos.context')->get(), 'index' ) ;
        $search = $productManager->filter( true )->slice( 0, 10000 )->order( ['-product.id'] );
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

        return view('front.marketplace.our_news', compact('sub_categories', 'attributes', 'productItems', 'request'));
    }
}
