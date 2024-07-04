/////////////////////////////////////////
/////////////// CAMPAGNES ///////////////
/////////////////////////////////////////

function cmpGlobalOpen(ref) {
    $("div#modal-cmp-detail h1").html("Détail de la campagne <strong>" + ref + "</strong>");
    $("#form_envoi_id").val(ref);

    $.getJSON(
        '../../controller/campagne/globalOpen.php', { ref: ref },
        function(data) {
            var listCmp = '<div id="daddy-cmp-detail" class="row d-flex justify-content-center mt-2">';
            for (var i = 0; i < data.length; i++) {
                var color = Math.round(255 - (100 * parseInt(data[i].volume) / 50000 * 2.55));

                switch (data[i].status) {
                    case "Envoyé":
                        var colorClass = 'e1';
                        break;
                    case "En cours":
                        var colorClass = 'e2';
                        break;
                    default:
                        var colorClass = 'e3';
                }

                var listRoutes = data[i].routes;
                var selectRoutes = '<select class="sel-route form-select bg-transparent border-0" id="r' + data[i].id + '">';
                $.each(listRoutes, function(key, value) {
                    if (value == data[i].route) {
                        selectRoutes += '<option value="' + key + '" selected>' + value + '</option>';
                    } else {
                        selectRoutes += '<option value="' + key + '">' + value + '</option>';
                    }
                });
                selectRoutes += '</select>';
                listCmp += `<div class=" col-xxl-3 card pr-2">
                <div class="cmp-detail p-2 text-center rounded box-generic" style="border-color: rgba(255, ${color}, 0, 1); background-color: rgba(255, ${color}, 0, 0.4);">
                    <div class="row">
                        <div class="col-6 text-end">
                        <span class="campagne">${data[i].campagne}</span>
                        </div>
                        <div class="col-6 text-start">
                        <span class="volume">${data[i].volume}</span>
                        </div>
                    </div>
                    <div class="input-group envoi my-2">
                        <div class="input-group-prepend">
                            <button class="btn btn-light envoi-single-cmp" type="button">
                                <i class="bi bi-envelope"></i>
                            </button>
                        </div>
                        <input class="form-control bg-transparent border-0" id="e${data[i].id}" type="text" value="${data[i].envoi}">
                        <div class="input-group-append">
                            <button class="btn btn-light valid-date" type="button">
                                <i class="bi bi-save"></i>
                            </button>
                        </div>
                    </div>
                
                    ${selectRoutes}
                    <div class="ribbon-wrapper">
                        <div class="ribbon ${colorClass}">
                        <span>${data[i].status}</span>
                        </div>
                    </div>
                </div></div>`;

            }
            listCmp += '</div>';

            $("#daddy-cmp-detail").remove();
            $("#modal-cmp-detail").append(listCmp);
        }
    );

}

function cmpGlobalApercu(ref) {
    var data = { ref: ref };

    $.ajax({
        url: "../../controller/campagne/globalApercu.php",
        type: "post",
        data: data,
        complete: function(xhr, result) {
            if (result == "success") {
                $('#modal_visu .modal-body').html('<iframe src="../../controller/campagne/rendu.html" style="width: 100%; height: 760px;"></iframe>');
                $('#modal_visu').modal('show');
            }
        }
    });
}

function cmpGlobalCopie(ref) {
    var data = { ref: ref };

    $.ajax({
        url: "../../controller/campagne/globalCopie.php",
        type: "post",
        data: data,
        complete: function(xhr, result) {
            if (result == "success") {
                var ret = xhr.responseText.split("|");
                if (ret[0] == "ok") {
                    currentMsg = ret[1] + ' campagnes copiées.';
                    $("#msg_success").click();
                    setTimeout(function() { window.location.reload() }, 1000);
                }
            }
        }
    });
}

function cmpGlobalRegen(ref) {
    var data = { ref: ref };

    $.ajax({
        url: "../../controller/campagne/returnMaxId.php",
        type: "post",
        data: data,
        complete: function(xhr, result) {
            if (result == "success") {
                var ret = xhr.responseText.split("|");
                if (ret[0] == "ok") {
                    document.location.href = "./campagne.php?edit=" + ret[1] + "&copie=yes";
                }
            }
        }
    });
}

function cmpGlobalEdit(ref) {
    $.getJSON(
        '../../controller/campagne/globalEdit.php', { ref: ref },
        function(data) {
            $("div#modal-cmp-edit h1").html("Édition de la campagne <strong>" + ref + "</strong>");
            $('input[name=this]').val(ref);

            $('#type_base option[value="' + data.type_base + '"]').prop('selected', true);
            $('#repasse option[value="' + data.repasse + '"]').prop('selected', true);
            $('#programme option[value="' + data.programme + '"]').prop('selected', true);

            $('input[name=client]').val(data.client);
            var campagne = data.campagne;
            $('input[name=campagne]').val(campagne.substring(0, campagne.length - 5));
            $('input[name=annonceur]').val(data.annonceur);
            $('input[name=sujet]').val(data.sujet);
            $('input[name=expediteur]').val(data.expediteur);
            $('#txtbrut').val(data.txt);
            $('input[name=adresse]').val(data.adresse);

            $('#domaine option[value="' + data.domaine + '"]').prop('selected', true);
            $('#route option[value="' + data.route + '"]').prop('selected', true);
            $('#ope option[value="' + data.operation + '"]').prop('selected', true);

            $('#bat').val(data.bat);
            $('input[name=prix]').val(data.prix);
            $('input[name=objectif]').val(data.objectif);

            var date = data.envoi;
            $('input[name=annee]').val(date.substring(0, 4));
            $('input[name=mois]').val(date.substring(5, 7));
            $('input[name=jour]').val(date.substring(8, 10));
            $('input[name=heure]').val(date.substring(11, 13));
            $('input[name=min]').val(date.substring(14, 16));
            $('input[name=sec]').val(date.substring(17, 19));

            if (data.miroir) {
                $('input[name=miroir]').prop('checked', true);
                $('input[name=miroir]').next().addClass("checked");
            } else {
                $('input[name=miroir]').prop('checked', false);
                $('input[name=miroir]').next().removeClass("checked");
            }

            tinyMCE.activeEditor.setContent(data.content);
            //tinymce.activeEditor.execCommand('mceInsertContent', false, "coucou");
            //tinymce.get("#tiny").execCommand('mceInsertContent', false, data.content);
            //tinymce.editors[0].execCommand('mceInsertContent', false, data.content);

            if (data.desabo) {
                $('input[name=desabo]').prop('checked', true);
                $('input[name=desabo]').next().addClass("checked");
            } else {
                $('input[name=desabo]').prop('checked', false);
                $('input[name=desabo]').next().removeClass("checked");
            }

            // Thématiques
            $("div#modal-cmp-edit form#form_campagne div.item_thematique label.checkbox-custom input").each(function() {
                $(this).prop('checked', false);
                $(this).next().removeClass("checked");
            });

            var thematiques = data.thematiques.split(",");
            for (var i = 0; i < thematiques.length; i++) {
                $('input[value=' + thematiques[i] + ']').prop('checked', true);
                $('input[value=' + thematiques[i] + ']').next().addClass("checked");
            }

            $("#modal-cmp-edit").css("display", "table");
        }
    );
}

function cmpGlobalDelete(ref) {
    if (confirm("Attention ! Toutes les campagnes associées seront supprimées.\nSupprimer toutes les campagnes ?")) {
        var data = { ref: ref };

        $.ajax({
            url: "../../controller/campagne/globalDelete.php",
            type: "post",
            data: data,
            complete: function(xhr, result) {
                if (result == "success") {
                    var ret = xhr.responseText.split("|");
                    if (ret[0] == "ok") {
                        currentMsg = ret[1] + ' sous-campagnes de ' + ref + ' supprimées.';
                        $("#msg_echec").click();

                        $("#" + ref).fadeOut("slow", function() {
                            $("#" + ref).remove();
                        });
                    }
                }
            }
        });
    }
}

function singleEnvoi(id) {
    console.log(id);
    var data = { id: id };

    $.ajax({
        url: "../../controller/campagne/singleEnvoi.php",
        type: "post",
        data: data,
        complete: function(xhr, result) {
            if (result == "success") {
                if (xhr.responseText == "ok") {
                    $("#" + id).parent().parent().find(".ribbon-wrapper .ribbon").removeClass("e1 e3").addClass("e2");
                    $("#" + id).parent().parent().find(".ribbon-wrapper .ribbon span").text("En cours");
                }
            }
        }
    });
}