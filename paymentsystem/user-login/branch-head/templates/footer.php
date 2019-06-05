

</div>
</div>
<aside id="sidebar">
    <strong class="logo"><a href="#">lg</a></strong>
    <ul class="tabset buttons">
        <?php
        @session_start();
        $url= $_SERVER['SERVER_NAME'].$_SERVER['REQUEST_URI'];
        $parseURL=preg_split("[/]",$url);

        ?>




        <?php
//        if ($parseURL[2]=='form_expense_summary.php') {
//            echo "<li class='active'>";
//        }else {
//            echo "<li>";
//        }
        ?>

        <!-- <a href="form_expense_summary.php" ><h6><i>Expense Summary</i></h6><span>Expense Summary</span><em></em></a>
        <span class="tooltip"><span>Generates Expense Summary Report</span></span> -->
        <!--</li>

        <?php
//        if ($parseURL[2]=='form_journal_entries.php') {
//            echo "<li class='active'>";
//        }else {
//            echo "<li>";
//        }
        ?>

        <a href="form_journal_entries.php" ><h6><i>Journal Entries</i></h6><span>Journal Entries</span><em></em></a>
        <span class="tooltip"><span>Generates Journal Entries</span></span>
        </li> -->
        <?php
        if ($_SESSION['position'] == 'Branch Head') {
            if ($parseURL[4]=='ap_accounts.php' || $parseURL[4]=='reliever_accounts.php') {
                echo "<li class='active'>";
            }else {
                echo "<li>";
            }
            ?>
        <a href="ap_accounts.php"><h6>Accounts</h6><span>[Accounts]</span><em></em></a>
        <span class="tooltip"><span>View Accounts</span></span>
    </li>
            <?php
        }
        ?>
        <li>
            <a href="settings.php" class="ico8"><span>Settings</span><em></em></a>
            <span class="tooltip"><span>Settings</span></span>
        </li>
    </ul>
    <span class="shadow"></span>
</aside>
</div>


