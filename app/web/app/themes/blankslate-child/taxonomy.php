<?php
get_header(); ?>

<div class="container taxonomy-container">
    <?php
    $term = get_queried_object();
    $fabricantes = get_terms( array(
        'taxonomy' => 'fabricantes',
        'hide_empty' => true,
    ) );
    $marcas = get_terms( array(
        'taxonomy' => 'marcas',
        'hide_empty' => true,
    ) );
    
    ?>
    
    <div class="taxonomy-wrapper flex gap-20">
        <!-- Panel de Filtros -->
        <aside class="filters-panel">
            <h3 class="filters-title">Seleccione vehículos</h3>

            <!-- Fabricantes -->
            <div class="filter-group">
                <label for="filter-fabricantes">Fabricantes</label>
                <select id="filter-fabricantes" class="filter-select" data-taxonomy="fabricantes">
                    <option value="">Seleccionar...</option>
                    <?php foreach ( $fabricantes as $fabricante ) : ?>
                        <option value="<?php echo esc_attr( $fabricante->term_id ); ?>"><?php echo esc_html( $fabricante->name ); ?></option>
                    <?php endforeach; ?>
                </select>
            </div>

            <!-- Marcas -->
            <div class="filter-group">
                <label for="filter-marcas">Marcas</label>
                <select id="filter-marcas" class="filter-select" data-taxonomy="marcas">
                    <option value="">Seleccionar...</option>
                    <?php foreach ( $marcas as $marca ) : ?>
                        <option value="<?php echo esc_attr( $marca->term_id ); ?>"><?php echo esc_html( $marca->name ); ?></option>
                    <?php endforeach; ?>
                </select>
            </div>

            <!-- Código OEM -->
            <div class="filter-group">
                <label for="filter-oem">Código OEM</label>
                <input type="text" id="filter-oem" class="filter-input" placeholder="Buscar...">
            </div>

            <!-- Códigos Fabricante -->
            <div class="filter-group">
                <label for="filter-fabricante-code">Códigos Fabricante</label>
                <input type="text" id="filter-fabricante-code" class="filter-input" placeholder="Buscar...">
            </div>

            <!-- Botón Contacto -->
            <div class="filter-contact">
                <a href="#" class="btn-contactanos"><i aria-hidden="true" class="fab fa-whatsapp"></i> Contáctanos</a>
                <p>Regista tus datos</p>
                <form class="contact-form">
                    <input type="text" placeholder="Nombre" required>
                    <input type="email" placeholder="Correo" required>
                    <button type="submit" class="btn-enviar">Enviar</button>
                </form>
            </div>
        </aside>

        <!-- Productos Grid -->
        <main class="productos-main">
            <div id="productos-grid" class="productos-grid">
                <?php 
                if (have_posts()) : 
                    $count = 0;
                    while (have_posts() && $count < 12) : 
                        the_post();
                        $count++;
                        ?>
                        <article class="producto-item">
                            <div class="producto-image">
                                <?php if (has_post_thumbnail()) : ?>
                                    <?php the_post_thumbnail('medium'); ?>
                                <?php endif; ?>
                            </div>
                            <h3 class="producto-title"><?php the_title(); ?></h3>
                            <a href="<?php the_permalink(); ?>" class="btn-ver-mas">Ver más</a>
                        </article>
                        <?php
                    endwhile;
                else : 
                    ?>
                    <p class="no-productos">No hay productos.</p>
                <?php endif; ?>
            </div>

            <!-- Botón Ver Más -->
            <?php 
            global $wp_query;
            if ($wp_query->found_posts > 12) :
            ?>
            <div class="ver-mas-container">
                <button id="load-more-btn" class="btn-ver-mas-productos" data-paged="2" data-term-id="<?php echo $term->term_id; ?>" data-taxonomy="<?php echo $term->taxonomy; ?>">
                    Ver más
                </button>
            </div>
            <?php endif; ?>
        </main>
    </div>
</div>

<?php get_footer(); ?>