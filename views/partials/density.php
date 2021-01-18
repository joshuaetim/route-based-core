<table class="table">
    <thead class="thead-dark">
        <tr>
            <th>Keyword</th>
            <th>Count</th>
            <th>Density</th>
        </tr>
    </thead>
    <?php 
        foreach($keywordArray as $key => $value){
    ?>
        <tr>
            <?php
                foreach($value as $key => $value){
                    echo "<td> {$value} </td>";
                }
            ?>
        </tr>
    <?php
        }
    ?>
</table>