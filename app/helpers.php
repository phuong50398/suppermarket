<?php
if (! function_exists('firstchars')) {
    function firstchars($string) {
        $words = explode(" ", $string);
        $acronym = "";
        foreach ($words as $w) {
        $acronym .= $w[0];
        }
        return strtoupper($acronym);
    }
}
if (! function_exists('stringcode')) {
    function stringcode($num, $index) {
        if($index == 2){
            return ($num>=10) ? $num : '0'.$num;
        }else{
            return ($num<10) ? '00'.$num : (($num<100) ? '0'.$num : $num);
        }
    }
}
if (! function_exists('checkSale')){
    function checkSale($listProduct, $listSale, $type=NULL)
    {
        $arrProduct = [];
        if($type==1){
            foreach ($listProduct as $key => $value) {
                $arrProduct[$value['product_id']] = $value;
                $arrProduct[$value['product_id']]['price'] = $value['product']['price'];
                $arrProduct[$value['product_id']]['provider_id'] = $value['product']['provider_id'];
                $arrProduct[$value['product_id']]['producer_id'] = $value['product']['producer_id'];
            }
        }else{
            foreach ($listProduct as $key => $value) {
                $arrProduct[$value['id']] = $value;
            }
        }
        
        foreach ($listSale as $ksale => $sale) {
            switch ($sale->type) {
                case '2':
                    if($sale->sale_all == 'all'){
                        foreach ($arrProduct as $id => $product) {
                            if(isset($arrProduct[$id]['price_sale'])){
                                $arrProduct[$id]['price_sale'] = ($sale->unit =='dong') ? $arrProduct[$id]['price_sale'] - $sale->discount : $arrProduct[$id]['price_sale'] - ($arrProduct[$id]['price_sale']*$sale->discount)/100;
                                $arrProduct[$id]['price_sale'] = ($arrProduct[$id]['price_sale']<0) ? '0' : $arrProduct[$id]['price_sale'];
                                $arrProduct[$id]['list_sale'] = $sale->id;
                            }else{
                                $arrProduct[$id]['price_sale'] = ($sale->unit =='dong') ? $arrProduct[$id]['price'] - $sale->discount : $arrProduct[$id]['price'] - ($arrProduct[$id]['price']*$sale->discount)/100;
                                $arrProduct[$id]['price_sale'] = ($arrProduct[$id]['price_sale']<0) ? '0' : $arrProduct[$id]['price_sale'];
                                $arrProduct[$id]['list_sale'] = $sale->id;
                            }
                        }
                    }else{
                        foreach($sale->saleProduct as $kpr => $product){
                            if(isset($arrProduct[$product['product_id']])){
                                if(isset($arrProduct[$product['product_id']]['price_sale'])){
                                    $arrProduct[$product['product_id']]['price_sale'] = ($product->unit =='dong') ? $arrProduct[$product['product_id']]['price_sale'] - $product->discount : $arrProduct[$product['product_id']]['price_sale'] - ($arrProduct[$product['product_id']]['price_sale']*$product->discount)/100;
                                    $arrProduct[$product['product_id']]['price_sale'] = ($arrProduct[$product['product_id']]['price_sale']<0) ? '0' : $arrProduct[$product['product_id']]['price_sale'];
                                    $arrProduct[$product['product_id']]['list_sale'] = $sale->id;
                                }else{
                                    $arrProduct[$product['product_id']]['price_sale'] = ($product->unit =='dong') ? $arrProduct[$product['product_id']]['price'] - $product->discount : $arrProduct[$product['product_id']]['price'] - ($arrProduct[$product['product_id']]['price']*$product->discount)/100;
                                    $arrProduct[$product['product_id']]['price_sale'] = ($arrProduct[$product['product_id']]['price_sale']<0) ? '0' : $arrProduct[$product['product_id']]['price_sale'];
                                    $arrProduct[$product['product_id']]['list_sale'] = $sale->id;
                                }
                            }
                        }
                    }
                    break;

                case '3':
                    if($sale->sale_all == 'all'){
                        foreach ($arrProduct as $id => $product) {
                            if(isset($arrProduct[$id]['price_sale'])){
                                $arrProduct[$id]['price_sale'] = ($sale->unit =='dong') ? $arrProduct[$id]['price_sale'] - $sale->discount : $arrProduct[$id]['price_sale'] - ($arrProduct[$id]['price_sale']*$sale->discount)/100;
                                $arrProduct[$id]['price_sale'] = ($arrProduct[$id]['price_sale']<0) ? '0' : $arrProduct[$id]['price_sale'];
                                $arrProduct[$id]['list_sale'] = $sale->id;
                            }else{
                                $arrProduct[$id]['price_sale'] = ($sale->unit =='dong') ? $arrProduct[$id]['price'] - $sale->discount : $arrProduct[$id]['price'] - ($arrProduct[$id]['price']*$sale->discount)/100;
                                $arrProduct[$id]['price_sale'] = ($arrProduct[$id]['price_sale']<0) ? '0' : $arrProduct[$id]['price_sale'];
                                $arrProduct[$id]['list_sale'] = $sale->id;
                            }
                        }
                    }else{
                        foreach ($sale->saleProduct as  $category) {
                            foreach ($arrProduct as $id => $product) {
                                if($category->category_type_id == $product['category_type_id']){
                                    if(isset($arrProduct[$id]['price_sale'])){
                                        $arrProduct[$id]['price_sale'] = ($category->unit =='dong') ? $arrProduct[$id]['price_sale'] - $category->discount : $arrProduct[$id]['price_sale'] - ($arrProduct[$id]['price_sale']*$category->discount)/100;
                                        $arrProduct[$id]['price_sale'] = ($arrProduct[$id]['price_sale']<0) ? '0' : $arrProduct[$id]['price_sale'];
                                        $arrProduct[$id]['list_sale'] = $sale->id;
                                    }else{
                                        $arrProduct[$id]['price_sale'] = ($category->unit =='dong') ? $arrProduct[$id]['price'] - $category->discount : $arrProduct[$id]['price'] - ($arrProduct[$id]['price']*$category->discount)/100;
                                        $arrProduct[$id]['price_sale'] = ($arrProduct[$id]['price_sale']<0) ? '0' : $arrProduct[$id]['price_sale'];
                                        $arrProduct[$id]['list_sale'] = $sale->id;
                                    }
                                }
                            }
                        }
                    }
                    break;

                case '4':
                    if($sale->sale_all == 'all'){
                        foreach ($arrProduct as $id => $product) {
                            if(isset($arrProduct[$id]['price_sale'])){
                                $arrProduct[$id]['price_sale'] = ($sale->unit =='dong') ? $arrProduct[$id]['price_sale'] - $sale->discount : $arrProduct[$id]['price_sale'] - ($arrProduct[$id]['price_sale']*$sale->discount)/100;
                                $arrProduct[$id]['price_sale'] = ($arrProduct[$id]['price_sale']<0) ? '0' : $arrProduct[$id]['price_sale'];
                                $arrProduct[$id]['list_sale'] = $sale->id;
                            }else{
                                $arrProduct[$id]['price_sale'] = ($sale->unit =='dong') ? $arrProduct[$id]['price'] - $sale->discount : $arrProduct[$id]['price'] - ($arrProduct[$id]['price']*$sale->discount)/100;
                                $arrProduct[$id]['price_sale'] = ($arrProduct[$id]['price_sale']<0) ? '0' : $arrProduct[$id]['price_sale'];
                                $arrProduct[$id]['list_sale'] = $sale->id;
                            }
                        }
                    }else{
                        foreach ($sale->saleProduct as  $producer) {
                            foreach ($arrProduct as $id => $product) {
                                if($producer->producer_id == $product['producer_id']){
                                    if(isset($arrProduct[$id]['price_sale'])){
                                        $arrProduct[$id]['price_sale'] = ($producer->unit =='dong') ? $arrProduct[$id]['price_sale'] - $producer->discount :  $arrProduct[$id]['price_sale'] - ($arrProduct[$id]['price_sale']*$producer->discount)/100;
                                        $arrProduct[$id]['price_sale'] = ($arrProduct[$id]['price_sale']<0) ? '0' : $arrProduct[$id]['price_sale'];
                                        $arrProduct[$id]['list_sale'] = $sale->id;
                                    }else{
                                        $arrProduct[$id]['price_sale'] = ($producer->unit =='dong') ? $arrProduct[$id]['price'] - $producer->discount :  $arrProduct[$id]['price'] - ($arrProduct[$id]['price']*$producer->discount)/100;
                                        $arrProduct[$id]['price_sale'] = ($arrProduct[$id]['price_sale']<0) ? '0' : $arrProduct[$id]['price_sale'];
                                        $arrProduct[$id]['list_sale'] = $sale->id;
                                    }
                                }
                            }
                        }
                    }
                    break;

                case '5':
                    if($sale->sale_all == 'all'){
                        foreach ($arrProduct as $id => $product) {
                            if(isset($arrProduct[$id]['price_sale'])){
                                $arrProduct[$id]['price_sale'] = ($sale->unit =='dong') ? $arrProduct[$id]['price_sale'] - $sale->discount : $arrProduct[$id]['price_sale'] - ($arrProduct[$id]['price_sale']*$sale->discount)/100;
                                $arrProduct[$id]['price_sale'] = ($arrProduct[$id]['price_sale']<0) ? '0' : $arrProduct[$id]['price_sale'];
                                $arrProduct[$id]['list_sale'] = $sale->id;
                            }else{
                                $arrProduct[$id]['price_sale'] = ($sale->unit =='dong') ? $arrProduct[$id]['price'] - $sale->discount : $arrProduct[$id]['price'] - ($arrProduct[$id]['price']*$sale->discount)/100;
                                $arrProduct[$id]['price_sale'] = ($arrProduct[$id]['price_sale']<0) ? '0' : $arrProduct[$id]['price_sale'];
                                $arrProduct[$id]['list_sale'] = $sale->id;
                            }
                        }
                    }else{
                        foreach ($sale->saleProduct as  $provider) {
                            foreach ($arrProduct as $id => $product) {
                                if($provider->provider_id == $product['provider_id']){
                                    if(isset($arrProduct[$id]['price_sale'])){
                                        $arrProduct[$id]['price_sale'] = ($provider->unit =='dong') ? $arrProduct[$id]['price_sale'] - $provider->discount : $arrProduct[$id]['price_sale'] - ($arrProduct[$id]['price_sale']*$provider->discount)/100;
                                        $arrProduct[$id]['price_sale'] = ($arrProduct[$id]['price_sale']<0) ? '0' : $arrProduct[$id]['price_sale'];
                                        $arrProduct[$id]['list_sale'] = $sale->id;
                                    }else{
                                        $arrProduct[$id]['price_sale'] = ($provider->unit =='dong') ? $arrProduct[$id]['price'] - $provider->discount : $arrProduct[$id]['price'] - ($arrProduct[$id]['price']*$provider->discount)/100;
                                        $arrProduct[$id]['price_sale'] = ($arrProduct[$id]['price_sale']<0) ? '0' : $arrProduct[$id]['price_sale'];
                                        $arrProduct[$id]['list_sale'] = $sale->id;
                                    }
                                }
                            }
                        }
                    }
                    break;

            
                default:
                    # code...
                    break;
            }
        }
        return $arrProduct;
    }
}
?>
