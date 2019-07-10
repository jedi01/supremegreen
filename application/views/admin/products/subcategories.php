
<?php 
if(isset($subcat) && !empty($subcat)){
  $array_name =  [];
foreach ($subcat as $key => $value) { 

  if($value->name == "TOPPINGS"){
      $arrayIndex = "top";
    }

    if($value->name == "PREMIUMS"){
      $arrayIndex = "pre";
    }

    if($value->name == "BASES"){
      $arrayIndex = "base";
    }

    if($value->name == "DRESSINGS"){
      $arrayIndex = "dress";
    }

  ?>
  <div class="form-group row">
    <label class="col-md-3 label-control" for="<?php echo $value->name; ?>" id="<?php echo $value->name; ?>"><?php echo $value->name; ?></label>
    <div class="col-md-9">
      <select name="<?=$arrayIndex?>[]" multiple required class="form-control select2 <?php echo $value->cat_id; ?> <?php echo $value->name; ?>" onchange="getCategoryLimit(<?=$value->cat_id?>);">
             <?php 

             if(isset($products) && !empty($products))
             {
              $productItems = [];
              $items_array = [];
              $encode_items = $products->product_items;
              $items = json_decode($encode_items);
              foreach ($items as $k => $v) {
                foreach ($v as $k1 => $v1) {
                  array_push($productItems,$v1->product);

                }
              }
            }
              $ingredients = ingredients($value->cat_id); 
              foreach ($ingredients as $key1 => $value1) { ?>
                <option value="<?php echo $value1->cat_pro_id ?>" <?php if(isset($products)){ if (in_array($value1->cat_pro_id, $productItems)){ echo "selected"; } }?>><?php echo $value1->cat_pro_name ?></option>
              <?php } ?>                 
      </select>
    </div>
  </div>
<?php 
  
  }
}



?>
<div class="form-group row skin skin-flat custom_made">
  <label class="col-md-3 label-control" for="product_custom">Product Custom Made</label>
  <div class="col-md-9">
    <input type="checkbox" name="product_custom" id="product_custom" value="1" <?php if(isset($products) && !empty($products->product_custom)){ echo "checked";} ?>>
  </div>
</div>


