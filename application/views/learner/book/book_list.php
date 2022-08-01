
<section role="main" class="content-body">
    <header class="page-header">
        <h2><?=$term["bookshop"]?></h2>

        <div class="right-wrapper">
        </div>
    </header>

    <input type="hidden" id="base_url" value="<?= base_url()?>">
    <!-- start: page -->
    <div class="row">
        <div class="col-lg-12">
            <section class="card">
                <header class="card-header">
                    <div class="card-actions">
                    </div>
                    <h2 class="card-title"><?=$term["booklist"]?></h2>
                </header>
                <div class="card-body">
                    <?php foreach($book_list as $book){ ?>
                    <section class="card card-featured-left card-featured-primary mb-4">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-3">
                                    <img src="<?=base_url()?><?=$book['image_path']?>" class="rounded img-fluid" alt="non-image">
                                </div>
                                <div class="col-md-9">
                                    <div class="widget-summary widget-summary-xlg">
                                        <div class="widget-summary-col">
                                            <div class="summary">
                                                <h4 class="title text-primary"><?=$book['title']?></h4></br>
                                                <div class="info">
                                                    <span class="text-block"> <?=$book['description']?></span></br>
                                                    <span class="text-block"> <h3>$<?=$book['price']?></h3></span>
                                                </div>
                                            </div>
                                            <div class="summary-footer">
                                                <a class="btn btn-primary modal-with-form " href="#" ><?=$term["purchase"]?>
                                                </a>
                                                <a class="btn btn-primary modal-with-form" href="<?=base_url()?>learner/book/viewBookDetail/<?=$book['id']?>" >
                                                    <?=$term["viewdetails"]?>
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </section>
                    <?php }?>
                </div>
            </section>
        </div>
    </div>

    <!-- end: page -->
</section>

