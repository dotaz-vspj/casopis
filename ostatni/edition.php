<?php session_start(); ?>
<?php include 'include/header.php'; ?>
<div class="container">
<?php for ($i = 0; $i < 5; $i++) {?>
    <div class="row mb-2 justify-content-center">
    
            <div class="placeholder ph-150x150"></div>
        
        <div class="col-sm-8">
            <h2><strong>Softwarové inženýrství pro umělou inteligenci</strong></h2>
            <h3>Redaktor: 
                <span class="author">Trégl Puc. Tomáš M. U. C.</span>
            </h3>
            <h4>Vydáno dne: 
                <span class="date-published" >2024-10-30</span>
            </h4>
            <p style="font-size: 16px;">International Conference on AI Engineering – Software Engineering for AI (CAIN)</p>
        </div>
    </div>
    <?php } ?>
    </div>

<?php include 'include/footer.php'; ?>
