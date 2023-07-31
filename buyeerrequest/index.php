<div class="col-md-8">
    <div class="card card-outline card-primary shadow rounded-0">
        <div class="card-body">
            <div class="container-fluid">
                <div class="card-tools">
                    <a href="javascript:void(0)" class="btn btn-flat btn-primary" id="create_new">
                        <span class="fas fa-plus"></span> Add a New Buyer Request
                    </a>
                </div><br>
                <div class="row justify-content-center mb-3">
                    <div class="col-lg-8 col-md-10 col-sm-12">
                        <form action="" id="search-frm">
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text">Search</span>
                                </div>
                                <input type="search" id="search" class="form-control"
                                    value="<?= isset($_GET['search']) ? $_GET['search'] : '' ?>">
                                <div class="input-group-append">
                                    <span class="input-group-text"><i class="fa fa-search"></i></span>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>

                <div class="row" id="product_list">
                    <?php 
                    $swhere = "";
                    if (isset($_GET['search']) && !empty($_GET['search'])) {
                        $search = $_GET['search'];
                        $swhere .= " AND (p.requestName LIKE '%$search%' OR p.description LIKE '%$search%' OR p.buyerName LIKE '%$search%')";
                    }

                    $brequest = $conn->query("SELECT p.*, c.requestName as `requestName` FROM `buyerreq_list` p 
                        INNER JOIN buyerreq_list c ON p.contactNo = c.contactNo 
                        WHERE 1 $swhere 
                        ORDER BY RAND()");

                    while ($row = $brequest->fetch_assoc()):
                    ?>
               
               <div class="col-md-12 mb-3">
                        <div class="card-body border-top border-gray">
                            <h5 class="card-title text-truncate w-100"><?= $row['requestName'] ?></h5>
                            <div class="d-flex w-100">
                                <div class="col-auto px-0"><small class="text-muted">Buyer Name: </small></div>
                                <div class="col-auto px-0 flex-shrink-1 flex-grow-1">
                                    <p class="text-truncate m-0"><small class="text-muted"><?= $row['buyerName'] ?></small></p>
                                </div>
                            </div>
                            <div class="d-flex">
                                <div class="col-auto px-0"><small class="text-muted">Importer ID: </small></div>
                                <div class="col-auto px-0 flex-shrink-1 flex-grow-1">
                                    <p class="text-truncate m-0"><small class="text-muted"><?= $row['importer_id'] ?></small></p>
                                </div>
                            </div>
                            <div class="d-flex">
                                <div class="col-auto px-0"><small class="text-muted">Contact No: </small></div>
                                <div class="col-auto px-0 flex-shrink-1 flex-grow-1">
                                    <p class="text-truncate m-0"><small class="text-muted"><?= $row['contactNo'] ?></small></p>
                                </div>
                            </div>
                            <div class="d-flex">
                                <div class="col-auto px-0"><small class="text-muted">Expected Price: Rs. </small></div>
                                <div class="col-auto px-0 flex-shrink-1 flex-grow-1">
                                    <p class="m-0 pl-3"><small class="text-primary"><?= format_num($row['price']) ?></small></p>
                                </div>
                            </div>
                            <p class="card-text truncate-3 w-100">Request Description: <?= strip_tags(html_entity_decode($row['description'])) ?></p>
                        </div>
                    </div>
                    <?php endwhile; ?>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
$(document).ready(function(){
    $('#create_new').click(function(){
        uni_modal('Add New Buyer Request', "buyeerrequest/manage_product.php", 'large');
    });

    $('table th,table td').addClass('align-middle px-2 py-1');
    $('.table').dataTable();
});

function delete_product($id){
    start_loader();
    $.ajax({
        url: _base_url_ + "classes/Master.php?f=delete_product",
        method: "POST",
        data: { id: $id },
        dataType: "json",
        error: function(err){
            console.log(err);
            alert_toast("An error occurred.", 'error');
            end_loader();
        },
        success: function(resp){
            if(typeof resp == 'object' && resp.status == 'success'){
                location.reload();
            }else{
                alert_toast("An error occurred.", 'error');
                end_loader();
            }
        }
    });
}
</script>
