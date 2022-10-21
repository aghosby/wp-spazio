<form role="search" method="get" action="<?= bloginfo('url'); ?>" id="searchform" class="search-form">
    <div class="row no-gutters">
        <div class="col">
            <input class="form-control rounded-0" type="text" name="s" id="s" placeholder="What are you looking for?" required>
        </div>
        <div class="col-auto">
            <button type="submit" class="btn btn-primary rounded-0">
                <i class="fa fa-search"></i>
            </button>
        </div>
    </div>
</form>