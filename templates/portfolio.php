<div id="middle">
    <table class="table table-striped">
        <thead>
            <tr>
                <th>
                    Symbols
                </th>
                <th>
                    Names
                </th>
                <th>
                    Shares
                </th>
                <th>
                    Price
                </th>
                <th>
                    Total
                </th>
            </tr>
        </thead>
        <tbody>    
            <?php
                foreach($positions as $position)
                {
                    print("<tr>");
                    print("<td>" . $position["symbol"] . "</td>");
                    print("<td>" . $position["name"] . "</td>");
                    print("<td>" . $position["shares"] . "</td>");      
                    print("<td> $" . $position["price"] . "</td>");
                    print("<td> $" . $position["total"] . "</td>");
                    print("</tr>");
                    $cashmoney = money_format('%i', $position["total"] + $cashmoney);
                }
                print("<tr>");
                print("<td colspan='4'>CASH</td>");
                print("<td>" . $cashmoney .  "</td>");
                print("</tr>");
               
            ?>
        </tbody>
    </table>
</div>
<div>
    <a href="logout.php">Log Out</a>
</div>
