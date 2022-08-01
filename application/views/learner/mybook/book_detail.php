
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

                </header>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-5">
                            <div class="col-md-9">
                                <img src="<?=base_url()?><?=$book['image_path']?>" class="rounded img-fluid" alt="learnerlearner">
                            </div>
                            <div class="row" style="margin-top: 5px">
                                <div class="col-md-3">
                                    <img src="<?=base_url()?><?=$book['picture1']?>" class="rounded img-fluid" alt="learnerlearner">
                                </div>
                                <div class="col-md-3">
                                    <img src="<?=base_url()?><?=$book['picture2']?>" class="rounded img-fluid" alt="learnerlearner">
                                </div>
                                <div class="col-md-3">
                                    <img src="<?=base_url()?><?=$book['picture3']?>" class="rounded img-fluid" alt="learnerlearner">
                                </div>
                                <div class="col-md-3">
                                    <img src="<?=base_url()?><?=$book['picture4']?>" class="rounded img-fluid" alt="learnerlearner">
                                </div>

                            </div>

                        </div>

                        <div class="col-md-7">
                            <h3><?=$book['title']?></h3><br/>
                            <h4><?=$book['description']?></h4>
                        </div>
                    </div>

                </div>
                <footer class="card-footer">
                    <div class="row">
                        <div class="col-md-12 text-right">
                            <a class="btn btn-primary modal-with-form " href="<?=base_url()?>learner/flipbook/view_book/<?=$book['id']?>" target="blank">
                                <i class="fa fa-plus"></i> <?=$term["viewbook"]?>
                            </a>
                        </div>
                    </div>
                </footer>

            </section>
        </div>

    </div>

    <!-- end: page -->
</section>

