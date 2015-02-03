<fieldset>
        <div>
            <?php
                print("A share of " . $stock["name"] . " ");
                print(" (" . $stock["symbol"] . ") ");
                print("costs $" . money_format('%i', $stock["price"]) . " ");    
            ?>
        </div>  
</fieldset>
  
<div>
    return to your <a href="index.php">Portfolio</a>
</div>c
