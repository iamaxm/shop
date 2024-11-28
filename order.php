<?php

session_start();
	
if(!isset($_SESSION["intLine"]))
{
	 $_SESSION["intLine"] = 0;
	 $_SESSION["strProduct_id"][0] = $_GET["Product_id"];
	 $_SESSION["strQty"][0] = 1;
	 header("location:index.php?id=shopping_cart");
}
else
{
	
	$key = array_search($_GET["Product_id"], $_SESSION["strProduct_id"]);
	if((string)$key != "")
	{
		 $_SESSION["strQty"][$key] = $_SESSION["strQty"][$key] + 1;
	}
	else
	{
		
		 $_SESSION["intLine"] = $_SESSION["intLine"] + 1;
		 $intNewLine = $_SESSION["intLine"];
		 $_SESSION["strProduct_id"][$intNewLine] = $_GET["Product_id"];
		 $_SESSION["strQty"][$intNewLine] = 1;
	}
	 header("location:index.php?id=shopping_cart");
}
?>