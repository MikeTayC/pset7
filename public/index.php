<?php

    // configuration
    require("../includes/config.php"); 
   
    //collect share information from user 
    $rows = query("SELECT symbol, shares FROM portfolios WHERE id = ?", $_SESSION["id"]);
   
    // collect information amount of cash user has
    $cash = query("SELECT cash FROM users WHERE id = ?", $_SESSION["id"]);
    $cashmoney = $cash[0]["cash"];
   
    $cashmoney = money_format('%i', $cashmoney); //10000
    
    
    //establish array to hold portfolio data
    $positions = [];
    
    foreach($rows as $row)
    {
        $stock = lookup($row["symbol"]);
        if ($stock !== false)
        {
            $positions[] = [
                "name" => $stock["name"],
                "price" => $stock["price"],
                "shares" => $row["shares"],
                "symbol" => $row["symbol"],
                "total" => money_format('%i', ($row["shares"])*($stock["price"] )),
             ];           
         }
    }
    
    
    // render portfolio
    render("portfolio.php", ["positions" => $positions,"cashmoney" => $cashmoney, "title" => "Portfolio"]);

?>
