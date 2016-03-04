<?php
   require_once __DIR__."/../vendor/autoload.php";
   require_once __DIR__."/../src/Brand.php";
   require_once __DIR__."/../src/Store.php";

   $app = new Silex\Application();

   $server = 'mysql:host=localhost;dbname=shoes';
   $username = 'root';
   $password = 'root';
   $DB = new PDO($server, $username, $password);

   $app->register(new Silex\Provider\TwigServiceProvider(), array(
   'twig.path' => __DIR__.'/../views'
   ));

   use Symfony\Component\HttpFoundation\Request;
   Request::enableHttpMethodParameterOverride();

   $app->get("/", function() use($app){
     return $app['twig']->render('index.html.twig');
   });
//STORE ROUTES
   $app->get("/stores", function() use($app){
     $stores = Store::getAll();
     return $app['twig']->render('stores.html.twig', array('stores' => $stores));
   });

   $app->post("/add_store", function() use($app){
     $name = $_POST['name'];
     $id = null;
     $new_store = new Store($name, $id);
     $new_store->save();
     $stores = Store::getAll();
     return $app['twig']->render('stores.html.twig', array('stores' => $stores));
   });

   $app->post("/delete_stores", function() use($app){
     Store::deleteAll();
     $stores = Store::getAll();
     return $app['twig']->render('stores.html.twig', array('stores' => $stores));
   });

   $app->get("/store/{id}", function($id) use($app){
     $store = Store::find($id);
     $brands = $store->getBrands();
     $all_brands = Brand::getAll();
     return $app['twig']->render('store.html.twig', array('store' => $store, 'brands' => $brands, 'all_brands' =>$all_brands));
   });

   $app->post("/store/{id}/add_brand", function($id) use($app){
     $brand = Brand::find($_POST['brand_id']);
     $store = Store::find($_POST['store_id']);
     $store->addBrand($brand);
     $brands = $store->getBrands();
     $all_brands = Brand::getAll();
     return $app['twig']->render('store.html.twig', array('store' => $store, 'brands' => $brand, 'all_brands' => $all_brands));
   });





//BRAND ROUTES
   $app->get("/brands", function() use($app){
     $brands = Brand::getAll();
     return $app['twig']->render('brands.html.twig', array('brands' => $brands));
   });

   $app->post("/add_brand", function() use($app){
     $name = $_POST['name'];
     $id = null;
     $new_brand = new Brand($name, $id);
     $new_brand->save();
     $brands = Brand::getAll();
     return $app['twig']->render('brands.html.twig', array('brands' => $brands));
   });

   $app->get("/brand/{id}", function($id) use ($app) {
      $brand = Brand::find($id);
      $stores = $brand->getStores();
      $all_stores = Store::getAll();
      return $app['twig']->render('brand.html.twig', array('brand' => $brand, 'stores' => $stores, 'all_stores' => $all_stores));
     });

     $app->post("/brand/{id}/add_store", function($id) use ($app) {
        $store = Store::find($_POST['store_id']);
        $brand = Brand::find($_POST['brand_id']);
        $brand->addStore($store);
        $stores = $brand->getStores();
        $all_stores = Store::getAll();
        return $app['twig']->render('brand.html.twig', array('brand' => $brand, 'stores' => $stores, 'all_stores' => $all_stores));
    });



   return $app;
 ?>
