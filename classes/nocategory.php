<?php

 /*
  * This class is useless. here just for me.
  */


 class NoCategory
 {

     // Return a list of all category groups
     public static function get_groups()
     {
         $sql = "SELECT * FROM category_group GROUP BY name ORDER BY name ASC";
         if(! $res = $this->db->query($sql) ) {
             trigger_error("A Database error occured in $sql : ". $this->db->error() );
         }
         $cats = array();
         while($row = $this->db->fetchArray($res) ) {
             $cats[] = $row;
         }
         return $cats;
     }

     public static function get_categories( $name )
     {
     	
     	if( Session::instance()->get('category_' . $name ) ){
     		return Session::instance()->get('category_' . $name );
     	}
     	
     	
     	$cats = DB::select('category.*')->select('category_group.*')
     		->from('category')->join('category_group', 'LEFT')->on('category_group.catid','=','category.catid')
     		->where('category_group.name','=',$name)->order_by('category_group.weight', 'ASC')->execute()->as_array();
     		
     	//echo Kohana::debug($cats);
		Session::instance()->set('category_' . $name, $cats );
        return $cats;
     }

     

     public static function get_list_values( $name, $append=array() )
     {
         $cats = self::get_categories($name);
         $values = ( $append ) ? $append : array() ;
         foreach($cats as $i=>$cat){
             $values[$cat['catid']] = __( ucwords($cat['langtag']) );
         }
         return $values;
     }

 }
