
<?php
require_once("inc/functions.php");
require_once("inc/conn.php");


$token = ""; //access token  
$shopUrl='namrata-shakya.myshopify.com'; //shop-url

class ProductCreation
{

     function fetchProduct($token,$conn){

        $qry=mysqli_query($conn,"select * from product");

		while( $row = mysqli_fetch_assoc($qry) ){
		echo "<pre>";

		$title=$row['title']; 
		$img=$row['image']; 
		$compare_at_price= $row['compare_price']; 
		$price= $row['price']; 
		$body= $row['description']; 

		$productArr= array (
		          'product' => 
			            array (
			              'title' => $title,
			              'body_html' => $body,
			              // 'vendor' => $vendor,
			              // 'product_type' => ,$productType,
			              // 'handle'=> $handle,
			              // 'tags'=> $tags,
			              // 'published' => $published,
			              'images' => array (
				                         array (
				                          'src' => $img,
				                        ),
			                         ),
			              'variants' => array ( 
							              array (
							                 'price' => $price,
							                 // 'sku' => $sku,
		                //                      'barcode'=> $barcode,
							                 // 'taxable'=> $taxable,
							                 // 'inventory_quantity' => $inventory_quantity,
							                  'inventory_quantity' => 50,
							                 // 'inventory_management'=>$inventory_management,
							                  'inventory_management'=>'shopify',
							                 'compare_at_price'=> $compare_at_price,
							                ),
							             ),
							               
		                     ),
			            );

	$product = shopify_call($token, "{apikey}:{password}@{hostname}", "/admin/api/2020-04/products.json", json_encode($productArr), 'POST',array("Content-Type: application/json"));
	   
        $product = json_decode($product['response'], JSON_PRETTY_PRINT);
         print_r($product); 
       
		}
     }	
}

echo "<pre>";

$obj=new ProductCreation();
$res=$obj->fetchProduct($token,$conn);












