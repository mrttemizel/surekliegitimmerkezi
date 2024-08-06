

$(document).ready(function() {

    $('#datatable').DataTable( {

        "dom": "<'row'<'col-sm-12 text-right mb-3'B>><'row'<'col-sm-6'l><'col-sm-6'f>>rtip",
        paging: true,
        scrollX: true,
        fixedHeader: {headerOffset: 45},
        buttons: {
            name: 'primary',
            buttons: [
                {extend:'excelHtml5',
                    className:'btn btn-success btn-sm text-white',
                    text:'Excel',
                    exportOptions: {
                        columns: ':not(:last-child)',
                    },
                },
                {
                    extend:'pdfHtml5',
                    className:'btn btn-info btn-sm text-white',
                    text:'PDF İNDİR<i class="fa fa-file-pdf-o"></i>',
                    download: 'open',


                    customize : function(doc) {
                        doc.styles['td:nth-child(1)'] = {
                            width: '1000px',
                            'max-width': '1000px'
                        }
                    },
                    orientation: 'landscape',
                    pageSize: 'A4',

                }
            ]
        },
        "lengthMenu": [[1, 10, 25, 50, 100, -1], [1, 10, 25, 50, 100, "Hepsi"]],
        "iDisplayLength":25,
        "pagingType": "full_numbers",
        "language": {
            "sDecimal":        ",",
            "sEmptyTable":     "Tabloda herhangi bir veri mevcut değil",
            "sInfo":           "_TOTAL_ kayıttan _START_ - _END_ arasındaki kayıtlar gösteriliyor",
            "sInfoEmpty":      "Kayıt yok",
            "sInfoFiltered":   "(_MAX_ kayıt içerisinden bulunan)",
            "sInfoPostFix":    "",
            "sInfoThousands":  ".",
            "sLengthMenu":     "Sayfada _MENU_ kayıt göster",
            "sLoadingRecords": "Yükleniyor...",
            "sProcessing":     "İşleniyor...",
            "sSearch":         "Ara:",
            "sZeroRecords":    "Eşleşen kayıt bulunamadı",
            "oPaginate": {
                "sFirst":    "İlk",
                "sLast":     "Son",
                "sNext":     "Sonraki",
                "sPrevious": "Önceki"
            },
            "oAria": {
                "sSortAscending":  ": artan sütun sıralamasını aktifleştir",
                "sSortDescending": ": azalan sütun sıralamasını aktifleştir"
            }
        }
    });
} );
