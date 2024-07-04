<?php include 'partials/session.php'; ?>
<?php include 'partials/main.php'; ?>

<?php
require("partials/class/Bdd.php");
$id = null;

if (isset($id)) {
    $bdd = new Bdd();
    $requete = "SELECT header_html, footer_html FROM gestion_routes WHERE id=" . $id;
    $resultat = $bdd->executeQueryRequete($requete, 1);
    $result = $resultat->fetch(PDO::FETCH_ASSOC);

    // var_dump($result);
}
?>

<head>

    <?php includeFileWithVariables('partials/title-meta.php', array('title' => 'Routes')); ?>

    <!--datatable css-->
    <link rel="stylesheet" href="assets/css/dataTables.bootstrap5.min.css">
    <!--datatable responsive css-->
    <link rel="stylesheet" href="assets/css/responsive.bootstrap.min.css">

    <link rel="stylesheet" href="assets/css/buttons.dataTables.min.css">
    <link rel="stylesheet" href="assets/libs/@tarekraafat/autocomplete.js/css/autoComplete.css">
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/5.0.0-beta3/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/noUiSlider/14.7.0/nouislider.min.css">


    <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
    <link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-lite.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-lite.min.js"></script>


    <?php include 'partials/head-css.php'; ?>

</head>

<style>
    #slider-container {
        display: flex;
        justify-content: center;
        align-items: center;
        height: 5vh;
    }

    #slider {
        width: 95%;
        height: 7px;
        margin: 0 auto;
        position: relative;
    }

    .noUi-horizontal .noUi-value {
        bottom: 100%;
        transform: translateY(-10px);
    }

    .noUi-horizontal .noUi-handle {
        top: -5px;
    }

    .noUi-horizontal .noUi-connect {
        background: #007bff;
    }
</style>


<script src="https://cdn.ckeditor.com/ckeditor5/41.2.0/super-build/ckeditor.js"></script>

<body>

    <!-- Begin page -->
    <div id="layout-wrapper">

        <?php include 'partials/menu.php'; ?>

        <!-- ============================================================== -->
        <!-- Start right Content here -->
        <!-- ============================================================== -->
        <div class="main-content">

            <div class="page-content">
                <div class="container-fluid">

                    <div class="page-title-box">
                        <div class="row align-items-center">
                            <div class="col-md-5">
                                <?php includeFileWithVariables('partials/page-title.php', array('pagetitle' => 'Gestion', 'title' => 'Routes')); ?>
                            </div><!--end col-->
                            <div class="col-md-auto ms-auto">
                                <?php include 'partials/customizer.php'; ?>
                            </div><!--end col-->
                        </div><!--end row-->
                    </div>

                    <div class="row">
                        <div class="col-lg-12">
                            <div class="card">
                                <div class="card-header d-flex align-items-center">
                                    <h5 class="card-title flex-grow-1 mb-0">Liste des routes</h5>
                                    <div class="flex-shrink-0">
                                        <button type="button" class="btn btn-primary add-btn" data-toggle="modal" data-target="#modal_new_route">
                                            <i class="bi bi-plus align-baseline"></i> Ajouter route
                                        </button>
                                    </div>
                                </div>
                                <div class="card-body">
                                    <div class="widget">
                                        <div class="widget-body innerAll inner-2x">
                                            <?php
                                            $selectDomaines = new Bdd();

                                            $requete = "SELECT gestion_routes.id, ip, gestion_routes.alias, username, password, port, ndd, tls, ok, gestion_domaine.nom AS domaine FROM gestion_routes, gestion_domaine WHERE gestion_domaine.id=gestion_routes.domaine ORDER BY gestion_routes.id";
                                            $result = $selectDomaines->executeQueryRequete($requete, 1);

                                            echo '<table id="scroll-horizontal" class="table table-bordered table-striped table-hover align-middle" style="width:100%">
                                                <thead class="bg-gray">
                                                    <tr>
                                                        <th style="text-align:start; width: auto;">Hostname</th>
                                                        <th style="text-align:start; width: auto;">Alias</th>
                                                        <th style="text-align:start; width: auto;">Username</th>
                                                        <th style="text-align:start; width: auto;">Password</th>
                                                        <th style="text-align:start; width: auto;">Port</th>
                                                        <th style="text-align:start; width: auto;">Domaine(s)</th>
                                                        <th style="text-align:start; width: auto;">TLS/SSL</th>
                                                        <th style="text-align:start; width: auto;">Domaine</th>
                                                        <th style="text-align:start; width: 135px">Actions</th>
                                                    </tr>
                                                </thead>
                                                <tbody>';

                                            while ($route = $result->fetch()) {
                                                $id = $route->id;
                                                echo '<tr id="nbroute' . $route->id . '">';
                                                echo '<td style="text-align:start; width: auto;">' . $route->ip . '</td>';
                                                echo '<td style="text-align:start; width: auto;">' . $route->alias . '</td>';
                                                echo '<td style="text-align:start; width: auto;">' . $route->username . '</td>';
                                                echo '<td style="text-align:start; width: auto;">' . $route->password . '</td>';
                                                echo '<td style="text-align:start; width: auto;">' . $route->port . '</td>';
                                                echo '<td style="text-align:start; width: auto;">' . nl2br($route->ndd) . '</td>';
                                                echo '<td style="text-align:start; width: auto;">' . strtoupper($route->tls) . '</td>';
                                                echo '<td style="text-align:start; width: auto;">' . $route->domaine . '</td>';
                                                $etat = $route->ok ? "info" : "danger";
                                                echo '<td style="text-align:center; width: 135px;" class="action_count" style="text-align:center;">
                                                    <button class="btn btn-' . $etat . ' btn-sm" onclick="checkRoute(' . $route->id . ')"><i class="bi bi-check"></i></button>
                                                    <button class="btn btn-success btn-sm" onclick="editRoute(' . $route->id . ')"><i class="bi bi-pencil"></i></button>
                                                    <button type="button" class="btn btn-danger btn-sm btn-sup" onclick="rmRoute(' . $route->id . ')"><i class="bx bxs-trash"></i></button>
                                                </td>';
                                                echo '</tr>';
                                            }
                                            echo '</tbody></table>';
                                            ?>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div><!--end col-->
                    </div><!--end row-->

                    <!-- Modal -->
                    <div class="modal fade" id="modal_new_route" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
                        <div class="modal-dialog modal-xl">
                            <div class="modal-content">
                                <div class="modal-header mb-4">
                                    <h4 class="modal-title" id="myLargeModalLabel">Ajouter un nouveau programme</h4>
                                    <button type="button" class="close bg-danger" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <form method="POST" action="routes_a.php" name="form_routes" id="form_routes">
                                    <div class="modal-body">
                                        <div class="row bg-light rounded g-1 p-2">
                                            <input name="new_edit" type="hidden" id="new_edit" value="0">

                                            <div class="col-xxl-6">
                                                <input name="ip" type="text" id="ip" class="form-control input-lg mb-1" placeholder="Hostname" required>
                                                <input name="username" type="text" id="username" class="form-control input-lg mb-1" placeholder="Username">
                                                <input name="port" type="text" id="port" class="form-control input-lg mb-1" placeholder="Port" required>
                                            </div>
                                            <div class="col-xxl-6">
                                                <input name="alias" type="text" id="alias" class="form-control input-lg mb-1" placeholder="Alias">
                                                <input name="password" type="password" id="password" class="form-control input-lg mb-1" placeholder="Password">
                                                <select name="tls" id="tls" class="form-control input-lg mb-1">
                                                    <option value=""></option>
                                                    <option value="tls">TLS</option>
                                                    <option value="ssl">SSL</option>
                                                </select>
                                            </div>
                                            <div class="col-xxl-12">
                                                <textarea name="ndd" id="ndd" class="form-control input-lg mb-1" placeholder="Domaine(s)" rows="4" required></textarea>
                                                <select name="domaine" class="form-control input-lg mb-1" id="domaine" required>
                                                    <option value="" class="date-value-ins"></option>
                                                    <?php
                                                    $requete = "SELECT id, Nom FROM gestion_domaine ORDER BY id";
                                                    $result = $selectDomaines->executeQueryRequete($requete, 1);

                                                    while ($domaine = $result->fetch()) {
                                                        echo '<option value="' . $domaine->id . '" class="date-value-ins">' . $domaine->nom . '</option>';
                                                    }
                                                    ?>
                                                </select><br />

                                                <div class="widget widget-heading-simple widget-body-gray">
                                                    <div class="row" id="timer-slider">
                                                        <div class="slider-range-min row form-horizontal">
                                                            <div class="col-xxl-3">
                                                                <div class="control-group row">
                                                                    <label class="col-lg-6 text-end control-label p-2">Timer en (ms):</label>
                                                                    <div class="col-lg-6">
                                                                        <input type="text" name="timer" class="amount form-control" id="input_timer" />
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div id="slider-container" class="col-xxl-9">
                                                                <div id="slider" class="slider slider-primary bg-primary"></div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>


                                                <div id="container" class="mt-2">
                                                    <textarea class="header_html" name="header_html" id="header_html" style="width: 55%;"></textarea>
                                                </div>
                                                <div class="mt-2 mb-1">
                                                    <textarea class="footer_html" name="footer_html" id="footer_html" style="width: 55%;"></textarea>
                                                </div>

                                            </div>
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn bg-light" data-dismiss="modal">Annuler</button>
                                        <button type="submit" class="btn btn-info">Ajouter</button>
                                    </div>
                                </form>

                            </div>
                        </div>
                    </div>

                    <div class="modal fade" id="modal_check_route" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
                        <div class="modal-dialog modal-xl">
                            <div class="modal-content">
                                <div class="modal-header mb-4">
                                    <h4 class="modal-title" id="myLargeModalLabel">Ajouter un nouveau programme</h4>
                                    <button type="button" class="close bg-danger" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <form method="POST" action="#" id="check_route">
                                    <div class="modal-body">
                                        <div class="row rounded bg-light g-2 p-2 p">
                                            <div class="col-lg-12">
                                                <input name="routeC" type="hidden" id="routeC" value="">
                                                <textarea name="email" id="email" class="form-control input-lg" placeholder="Emails(s)" rows="4" required></textarea>
                                            </div>
                                            <div class="col-lg-6">
                                                <input type="text" name="from" class="amount form-control" id="from" />
                                            </div>
                                            <div class="col-lg-6 pt-2 mef-dom-routes">
                                                <span id="from-right"></span>
                                            </div><br>
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn bg-light" data-dismiss="modal">Annuler</button>
                                        <button type="submit" class="btn btn-info">Tester</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>

                </div>
                <!-- container-fluid -->
            </div>
            <!-- End Page-content -->

            <?php include 'partials/footer.php'; ?>
        </div>
        <!-- end main content-->

    </div>
    <!-- END layout-wrapper -->

    <?php include 'partials/vendor-scripts.php'; ?>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>

    <!--datatable js-->
    <script src="assets/js/pages/jquery.dataTables.min.js"></script>
    <script src="assets/js/pages/dataTables.bootstrap5.min.js"></script>
    <script src="assets/js/pages/dataTables.responsive.min.js"></script>
    <script src="assets/js/pages/dataTables.buttons.min.js"></script>
    <script src="assets/js/script.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/2.11.6/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script src="assets/js/pages/datatables.init.js"></script>
    <!-- App js -->
    <script src="assets/js/app.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/noUiSlider/14.7.0/nouislider.min.js"></script>

    <script>
        var slider = document.getElementById('slider');
        // Initialiser le slider avec noUiSlider
        noUiSlider.create(slider, {
            start: [50],
            range: {
                'min': [0],
                'max': [100]
            },
            pips: {
                mode: 'steps',
                density: 10
            }
        });
        // Ajouter un écouteur d'événement pour les clics sur les pips
        slider.querySelectorAll('.noUi-value').forEach(function(pip) {
            pip.style.cursor = 'pointer';

            pip.addEventListener('click', function() {
                var value = Number(pip.getAttribute('data-value'));
                slider.noUiSlider.set(value);
            });
        });
    </script>
    <script>

        $('#header_html').summernote({
            placeholder: 'Coller votre code dans source </>',
            tabsize: 17,
            height: 425,
            toolbar: [
                ['style', ['style']],
                ['font', ['bold', 'underline', 'clear']],
                ['color', ['color']],
                ['para', ['ul', 'ol', 'paragraph']],
                ['table', ['table']],
                ['insert', ['link', 'picture', 'video']],
                ['view', ['fullscreen', 'codeview', 'help']]
            ]
        });

    </script>    
</body>


<script>

    var e_footer_html = CKEDITOR.ClassicEditor.create(document.getElementById("footer_html"), {
        // https://ckeditor.com/docs/ckeditor5/latest/features/toolbar/toolbar.html#extended-toolbar-configuration-format
        toolbar: {
            items: [
                'exportPDF', 'exportWord', '|',
                'findAndReplace', 'selectAll', '|',
                'heading', '|',
                'bold', 'italic', 'strikethrough', 'underline', 'code', 'subscript', 'superscript', 'removeFormat', '|',
                'bulletedList', 'numberedList', 'todoList', '|',
                'outdent', 'indent', '|',
                'undo', 'redo',
                '-',
                'fontSize', 'fontFamily', 'fontColor', 'fontBackgroundColor', 'highlight', '|',
                'alignment', '|',
                'link', 'uploadImage', 'blockQuote', 'insertTable', 'mediaEmbed', 'codeBlock', 'htmlEmbed', '|',
                'specialCharacters', 'horizontalLine', 'pageBreak', '|',
                'textPartLanguage', '|',
                'sourceEditing'
            ],
            shouldNotGroupWhenFull: true
        },
        // Changing the language of the interface requires loading the language file using the <script> tag.
        // language: 'es',
        list: {
            properties: {
                styles: true,
                startIndex: true,
                reversed: true
            }
        },
        // https://ckeditor.com/docs/ckeditor5/latest/features/headings.html#configuration
        heading: {
            options: [{
                    model: 'paragraph',
                    title: 'Paragraph',
                    class: 'ck-heading_paragraph'
                },
                {
                    model: 'heading1',
                    view: 'h1',
                    title: 'Heading 1',
                    class: 'ck-heading_heading1'
                },
                {
                    model: 'heading2',
                    view: 'h2',
                    title: 'Heading 2',
                    class: 'ck-heading_heading2'
                },
                {
                    model: 'heading3',
                    view: 'h3',
                    title: 'Heading 3',
                    class: 'ck-heading_heading3'
                },
                {
                    model: 'heading4',
                    view: 'h4',
                    title: 'Heading 4',
                    class: 'ck-heading_heading4'
                },
                {
                    model: 'heading5',
                    view: 'h5',
                    title: 'Heading 5',
                    class: 'ck-heading_heading5'
                },
                {
                    model: 'heading6',
                    view: 'h6',
                    title: 'Heading 6',
                    class: 'ck-heading_heading6'
                }
            ]
        },
        // https://ckeditor.com/docs/ckeditor5/latest/features/editor-placeholder.html#using-the-editor-configuration
        placeholder: 'Editer le template!',
        // https://ckeditor.com/docs/ckeditor5/latest/features/font.html#configuring-the-font-family-feature
        fontFamily: {
            options: [
                'default',
                'Arial, Helvetica, sans-serif',
                'Courier New, Courier, monospace',
                'Georgia, serif',
                'Lucida Sans Unicode, Lucida Grande, sans-serif',
                'Tahoma, Geneva, sans-serif',
                'Times New Roman, Times, serif',
                'Trebuchet MS, Helvetica, sans-serif',
                'Verdana, Geneva, sans-serif'
            ],
            supportAllValues: true
        },
        // https://ckeditor.com/docs/ckeditor5/latest/features/font.html#configuring-the-font-size-feature
        fontSize: {
            options: [10, 12, 14, 'default', 18, 20, 22],
            supportAllValues: true
        },
        // Be careful with the setting below. It instructs CKEditor to accept ALL HTML markup.
        // https://ckeditor.com/docs/ckeditor5/latest/features/general-html-support.html#enabling-all-html-features
        htmlSupport: {
            allow: [{
                name: /.*/,
                attributes: true,
                classes: true,
                styles: true
            }]
        },
        // Be careful with enabling previews
        // https://ckeditor.com/docs/ckeditor5/latest/features/html-embed.html#content-previews
        htmlEmbed: {
            showPreviews: true
        },
        // https://ckeditor.com/docs/ckeditor5/latest/features/link.html#custom-link-attributes-decorators
        link: {
            decorators: {
                addTargetToExternalLinks: true,
                defaultProtocol: 'https://',
                toggleDownloadable: {
                    mode: 'manual',
                    label: 'Downloadable',
                    attributes: {
                        download: 'file'
                    }
                }
            }
        },
        // https://ckeditor.com/docs/ckeditor5/latest/features/mentions.html#configuration
        mention: {
            feeds: [{
                marker: '@',
                feed: [
                    '@apple', '@bears', '@brownie', '@cake', '@cake', '@candy', '@canes', '@chocolate', '@cookie', '@cotton', '@cream',
                    '@cupcake', '@danish', '@donut', '@dragée', '@fruitcake', '@gingerbread', '@gummi', '@ice', '@jelly-o',
                    '@liquorice', '@macaroon', '@marzipan', '@oat', '@pie', '@plum', '@pudding', '@sesame', '@snaps', '@soufflé',
                    '@sugar', '@sweet', '@topping', '@wafer'
                ],
                minimumCharacters: 1
            }]
        },
        // The "superbuild" contains more premium features that require additional configuration, disable them below.
        // Do not turn them on unless you read the documentation and know how to configure them and setup the editor.
        removePlugins: [
            // These two are commercial, but you can try them out without registering to a trial.
            // 'ExportPdf',
            // 'ExportWord',
            'AIAssistant',
            'CKBox',
            'CKFinder',
            'EasyImage',
            // This sample uses the Base64UploadAdapter to handle image uploads as it requires no configuration.
            // https://ckeditor.com/docs/ckeditor5/latest/features/images/image-upload/base64-upload-adapter.html
            // Storing images as Base64 is usually a very bad idea.
            // Replace it on production website with other solutions:
            // https://ckeditor.com/docs/ckeditor5/latest/features/images/image-upload/image-upload.html
            // 'Base64UploadAdapter',
            'RealTimeCollaborativeComments',
            'RealTimeCollaborativeTrackChanges',
            'RealTimeCollaborativeRevisionHistory',
            'PresenceList',
            'Comments',
            'TrackChanges',
            'TrackChangesData',
            'RevisionHistory',
            'Pagination',
            'WProofreader',
            // Careful, with the Mathtype plugin CKEditor will not load when loading this sample
            // from a local file system (file://) - load this site via HTTP server if you enable MathType.
            'MathType',
            // The following features are part of the Productivity Pack and require additional license.
            'SlashCommand',
            'Template',
            'DocumentOutline',
            'FormatPainter',
            'TableOfContents',
            'PasteFromOfficeEnhanced',
            'CaseChange'
        ]
    })

    function editRoute(id) {
        //   console.log(e_footer_html);

        $.getJSON(
            '../controller/editRoute.php', {
                send: id
            },

            function(data) {
                if (id !== null) {

                    //Ajouter des données du header provenant de la base de données
                    e_header_html.then(editor => {
                            if (data) {
                                editor.setData(data.header_html);
                            }
                        })
                        .catch(error => {
                            console.error(error);
                        });
                    //Ajouter des données du footer provenant de la base de données
                    e_footer_html.then(editor2 => {
                            editor2.setData(data.footer_html);
                        })
                        .catch(error => {
                            console.error(error);
                        });

                }

                $("#new_edit").val(id);
                $("#ip").val(data.ip);
                $("#alias").val(data.alias);
                $("#username").val(data.username);
                $("#password").val(data.password);
                $("#port").val(data.port);
                $("#ndd").val(data.ndd);
                $("#domaine").val(data.domaine);
                $("#input_timer").val(data.timer);
                $("#tls").val(data.tls);



                // jqueryui-sliders.init.js
                $("#timer-slider .slider-range-min .slider").slider({
                    create: JQSliderCreate,
                    range: "min",
                    value: data.timer,
                    min: 0,
                    max: 10000,
                    slide: function(event, ui) {
                        $("#timer-slider .slider-range-min .amount").val(ui.value);
                        $("#date").val(ui.value);
                    },
                    start: function() {
                        if (typeof mainYScroller != 'undefined') mainYScroller.disable();
                    },
                    stop: function() {
                        if (typeof mainYScroller != 'undefined') mainYScroller.enable();
                    }
                });
                $("#timer-slider .slider-range-min .amount").val($("#timer-slider .slider-range-min .slider").slider("value"));


                $("#modal_new_route").modal('show');
            }
        );
    }

    //Modifier les données

    /* $(document).ready(function(){


         // Fonction pour récupérer et remplir les données existantes
         function getExistingData(id) {
             $.ajax({
                 type: 'GET',
                 url: './controller/editFtp.php;
                 success: function(data){
                     var obj = JSON.parse(data);
                     $('#id').val(obj.id);
                     $('#host').val(obj.host);
                     $('#username').val(obj.username);
                     $('#password').val(obj.password);
                     $('#port').val(obj.port);
                     $('#pays').val(obj.pays);
                     $('#code_pays').val(obj.code_pays);
                     $('#destination').val(obj.destination);
                     $('#priorite').val(obj.priorite);
                 }
             });

         }

         // Appel de la fonction pour récupérer les données existantes lors du chargement de la page
         getExistingData();

         // Soumission du formulaire

         $('#form_routes').submit(function(event){
             event.preventDefault();
             var formData = $(this).serialize();
             $.ajax({
                 type: 'POST',
                 url: $(this).attr('action'),
                 data: formData,
                 success: function(response){
                     $('#response').html(response);
                 }
             });
         });


     });*/
</script>

</html>