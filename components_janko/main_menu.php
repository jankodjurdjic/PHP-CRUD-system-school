<nav class="navbar navbar-default">
    <div class="container-fluid">
        <!-- Brand and toggle get grouped for better mobile display -->
        <div class="navbar-header">
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="#">Simanic comapany</a>
        </div>

        <!-- Collect the nav links, forms, and other content for toggling -->
        <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
            <ul class="nav navbar-nav">
                <li <? ($active_menu_item == 'ucenici') ? print 'class="active"' : print ""; ?>><a href="ucenici.php">Ucenici</a></li>
                <li <? ($active_menu_item == 'skole_janko') ? print 'class="active"' : print ""; ?>><a href="skole_janko.php">Skole</a></li>
                <li <? ($active_menu_item == 'statistika') ? print 'class="active"' : print ""; ?>><a href="statistika.php">Statistika</a></li>
            </ul>
            <ul class="nav navbar-nav navbar-right">
                <div class="navbar-form navbar-left">
                    <div class="form-group">
                        <input type="text" class="form-control submitEnter" id="search-term-<?=$active_menu_item ?>" placeholder="Search" data-url="http://jpdesign.ba/sime_test/ucenici_janko/ucenici.php" autocomplete="off" value="<?=$search_term; ?>">
                    </div>
                    <!--button type="submit" class="btn btn-default">Submit</button-->
                    <div class="dropdown" id="search-results" style="display: none;">
                        <ul class="dropdown-menu" id="search-result-list" style="display: block;">

                        </ul>
                    </div>
                </div>
            </ul>
        </div><!-- /.navbar-collapse -->
    </div><!-- /.container-fluid -->
</nav>
