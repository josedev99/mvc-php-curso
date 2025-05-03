<!-- body -->
        <section>
            <div class="card">
                <div class="card-body">
                    <h2>Página principal</h2>
                    <hr>
                    <div class="card" style="width: 18rem;">
                        <img src="data:image/png;base64,<?php echo base64_encode($_SESSION['fotografía']); ?>" class="card-img-top" alt="User">
                        <div class="card-body">
                            <p class="card-text">Bienveido/a <strong><?php echo $_SESSION['nombrecompleto']; ?></strong></p>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <br>
        <!-- end body -->