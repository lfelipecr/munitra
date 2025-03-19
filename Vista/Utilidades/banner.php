
<?php
    header("Content-Type: text/css");
    if (isset($_GET['url'])){
        $url = $_GET['url'];
        if ($url != '') {?>
            <style>
                .masthead {
                    position: relative;
                    background-color: #343a40;
                    background-size: cover;
                    padding-top: 8rem;
                    padding-bottom: 8rem;
                    background: url("./repo/<?php echo $url; ?>") no-repeat center center;
                }
        
                header.masthead:before {
                    content: "";
                    position: absolute;
                    height: 100%;
                    width: 100%;
                    top: 0;
                    left: 0;
                }
            </style>
        <?php } ?>
    <?php } else { ?>
        <style>
            .masthead {
                position: relative;
                background-color:rgb(27, 78, 129);
                background-size: cover;
                padding-top: 8rem;
                padding-bottom: 8rem;
                background: url("../../Web/assets/img/banner-rio-cuarto.png") no-repeat center center;
            }
    
            header.masthead:before {
                content: "";
                position: absolute;
                height: 100%;
                width: 100%;
                top: 0;
                left: 0;
            }
        </style>
    <?php } ?>