
<style>
    .payment-type, .payment-detail{
        padding:10px;
        background-color: white;
        border: solid 1px #43dad5;
        border-radius: 4%;
        margin-left: 32px;
    }
    .payment-type .row{
        text-align: center;
        margin-top: 15px;
    }
    .checkmark{
        left: 110px;
    }
    .p-2{
        padding: 1rem;
    }
    .px-2{
        padding-left: 1rem;
        padding-right: 1rem;
    } 
    .mx-2{
        margin-left: 1rem;
        margin-right:1rem;
    }
    .border-top{
        border-top: solid 1px green;
    }
</style>
<section class="loginAndSignSection selectPlan">
    <div class="container">
        <div class="row">
            <div class="col-lg-2 col-xs-12 col-sm-2"></div>
            <div class="col-lg-12 col-xs-12 col-sm-12">
                <h3 class="selectPlanTitles">Thanks your payment was successful.</h3>
                <div class="timelineSelectPlan">
                    <div class="circlNum leftNum ">01</div>
                    <div class="circlNum rightNum activeTime">02</div>
                </div>
                <div class="wrapNext">
                    <a href="<?= $redirect?>" class="nextBTN outlineBTN">Back</a>
                </div>
            </div>
            <div class="col-lg-2 col-xs-12 col-sm-2"></div>
        </div>
    </div>
</section>