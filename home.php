<style>
    
</style>
<div class="card mb-3" >
  <div class="row g-0">
    <div class="col-md-4">
      <img src="uploads/logo.png" class="img-fluid rounded-start" alt="...">
    </div>
    <div class="col-md-8">
      <div class="card-body">
        <div class="card-title"><h5>Welcome to the Sri Lanka Import Export Management Platform!</div></h5>
        <p class="card-text"><br>We are thrilled to introduce an innovative and transformative solution to address the challenges faced by 
            businesses in Sri Lanka due to import restrictions and inflation. Our platform is designed to revolutionize the nation's trade 
            ecosystem, empowering local businesses, and stimulating economic growth. We invite you to join us on this exciting journey as we 
            reshape the trade landscape of Sri Lanka. Whether you are an exporter seeking new markets or an importer searching for high-quality 
            local products, our platform is here to connect you with the right partners and opportunities.<br><br>
            Thank you for visiting the Sri Lanka Import Export Management Platform. Together, let's unlock the true potential of Sri Lankan 
            businesses and foster economic growth that benefits us all. <br><br><b>Welcome aboard!....</b></p>
    
      </div>
    </div>
  </div>
</div>
        <div class="clear-fix mb-3"></div>
        <div class="text-center"><h3>Our Services</h3></div>
        <center><hr class="w-25"></center>
        <div class="row row-cols-1 row-cols-md-3 g-4">
  <div class="col">
    <div class="card h-100">
      <img src="uploads/OS1.png" class="card-img-top" alt="...">
      <div class="card-body">
        <span class="card-title"><h5>Great value</h5></span>
        <p class="card-text">We strive to provide excellent value to our users by offering a platform that optimizes trade processes, reduces costs,
             and increases efficiency. Unlock new opportunities and maximize your business potential with our value-driven solutions.</p>
      </div>
    </div>
  </div>
  <div class="col">
    <div class="card h-100">
      <img src="uploads/OS2.png" class="card-img-top" alt="...">
      <div class="card-body">
      <span class="card-title"><h5>Safe payment</h5></span>
        <p class="card-text">Rest assured that your financial transactions are secure on our platform. 
            We prioritize the safety and confidentiality of your payments, ensuring a trustworthy environment for all transactions.</p>
      </div>
    </div>
  </div>
  <div class="col">
    <div class="card h-100">
      <img src="uploads/OS3.png" class="card-img-top" alt="...">
      <div class="card-body">
      <span class="card-title"><h5>Fast Delivery</h5></span>
        <p class="card-text">Time is a essence in the import-export industry. Our platform enables swift and reliable delivery of goods, 
            ensuring that your products reach their destination in a timely manner.</p>
      </div>
    </div>
  </div>
  <div class="col"><br>
    <div class="card h-100">
      <img src="uploads/OS4.png" class="card-img-top" alt="...">
      <div class="card-body">
      <span class="card-title"><h5>Business Support</h5></span>
        <p class="card-text">We are committed to supporting your business every step of the way. Our platform offers comprehensive business support 
            services, including market insights, regulatory guidance, and professional assistance. Count on us to be your reliable partner in business growth.</p>
      </div>
    </div>
  </div>
  <div class="col"><br>
    <div class="card h-100">
      <img src="uploads/OS5.png" class="card-img-top" alt="...">
      <div class="card-body">
      <span class="card-title"><h5>Save Economy</h5></span>
        <p class="card-text">By fostering local trade and reducing dependency on imports, we contribute to the stability and growth of the Sri Lankan economy. 
            Embrace sustainable practices and help build a stronger and more self-reliant economy through our platform.</p>
      </div>
    </div>
  </div>
  <div class="col"><br>
    <div class="card h-100">
      <img src="uploads/OS6.png" class="card-img-top" alt="...">
      <div class="card-body">
      <span class="card-title"><h5>24X7 Support</h5></span>
        <p class="card-text">We understand that questions and challenges can arise at any time. That's why our dedicated support team is available round the clock to 
            assist you. Whether you need technical support or have inquiries about our services, we are here to provide prompt and reliable assistance.</p>
      </div>
    </div>
  </div>
</div><br>
        <div class="clear-fix mb-3"></div>
        <div class="text-center"><h3>Products</h3></div>
        <center><hr class="w-25"></center>
        <div class="row" id="product_list">
            <?php 
            $products = $conn->query("SELECT p.*, v.shop_name as exporter, c.name as `category` FROM `product_list` p inner join exporter_list v on p.exporter_id = v.id inner join category_list c on p.category_id = c.id where p.delete_flag = 0 and p.`status` =1 order by RAND() limit 4");
            while($row = $products->fetch_assoc()):
            ?>
            <div class="col-lg-3 col-md-6 col-sm-12 product-item">
                <a href="./?page=products/view_product&id=<?= $row['id'] ?>" class="card shadow rounded-0 text-reset text-decoration-none">
                <div class="product-img-holder position-relative">
                    <img src="<?= validate_image($row['image_path']) ?>" alt="Product-image" class="img-top product-img bg-gradient-gray">
                </div>
                    <div class="card-body border-top border-gray">
                        <h5 class="card-title text-truncate w-100"><?= $row['name'] ?></h5>
                        <div class="d-flex w-100">
                            <div class="col-auto px-0"><small class="text-muted">exporter: </small></div>
                            <div class="col-auto px-0 flex-shrink-1 flex-grow-1"><p class="text-truncate m-0"><small class="text-muted"><?= $row['exporter'] ?></small></p></div>
                        </div>
                        <div class="d-flex">
                            <div class="col-auto px-0"><small class="text-muted">Category: </small></div>
                            <div class="col-auto px-0 flex-shrink-1 flex-grow-1"><p class="text-truncate m-0"><small class="text-muted"><?= $row['category'] ?></small></p></div>
                        </div>
                        <div class="d-flex">
                            <div class="col-auto px-0"><small class="text-muted">Price: Rs. </small></div>
                            <div class="col-auto px-0 flex-shrink-1 flex-grow-1"><p class="m-0 pl-3"><small class="text-primary"><?= format_num($row['price']) ?></small></p></div>
                        </div>
                        <p class="card-text truncate-3 w-100"><?= strip_tags(html_entity_decode($row['description'])) ?></p>
                    </div>
                </a>
            </div>
            <?php endwhile; ?>
        </div>
        <div class="clear-fix mb-2"></div>
        <div class="text-center">
            <a href="./?page=products" class="btn btn-large btn-primary rounded-pill col-lg-3 col-md-5 col-sm-12">Explore More Products</a>
        </div>
    </div>
</div>