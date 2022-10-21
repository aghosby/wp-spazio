<?php

// Categories Helper Function 
function categories() {

    $i = 0;
    $categories = count(get_the_category());

    foreach((get_the_category()) as $category){

        $name = $category->name;
        $category_link = get_category_link( $category->term_id );

        $i++;
        if($categories > 1 && $categories != $i) { ?>

<a class="cat-link" href="<?= $category_link ?>"><?= $name ?></a><?php echo ", " ?>

<?php } elseif ( $i = $categories) { ?>
<a class="cat-link" href="<?= $category_link ?>"><?= $name ?></a>
<?php } else { ?>
<a class="cat-link" href="<?= $category_link ?>"><?= $name ?></a>
<?php }

    }
}