class datatablesController
  constructor: ->

    @events =
#      'click a.borrar': 'deleteElement'

    @initialize()

  initialize: ->

    if $('#items_list').length > 0
      element = $('#items_list')
      bsort = if element.attr('data-sort') then element.attr('data-sort') else "true"
      bsort = (bsort == "true")
      tabla = $('#items_list').dataTable(
        'iDisplayLength': 100
        'bSort': Boolean(bsort)
        'sDom': '<\'row no-gutter\'<\'col-sm-6\'l><\'col-sm-6\'f>>' + '<\'table-responsive\'<\'row no-gutter\'<\'col-sm-12\'tr>>>' + '<\'row no-gutter\'<\'col-sm-5\'i><\'col-sm-7\'p>>'
        # 'sDom': '<\'row\'<\'col-lg-4\'l><\'col-lg-8\'<\'pull-right\'f>> r>t<\'row\'<\'col-lg-4\'i><\'col-lg-8\'p>>'
        'sWrapper': 'dataTables_wrapper form-inline dt-bootstrap'
        'sFilterInput': 'form-control input-sm'
        'sLengthSelect': 'form-control input-sm'
        'sPaginationType': 'full_numbers'
        'renderer': 'bootstrap'
        'oLanguage':
          'sEmptyTable': 'No hay datos'
          'sInfo': '_START_ hasta _END_ de _TOTAL_'
          'sInfoEmpty': '0 registros'
          'sInfoFiltered': '(_MAX_ en total)'
          'sInfoPostFix': ''
          'sInfoThousands': ','
          'sLengthMenu': 'Mostrar _MENU_'
          'sLoadingRecords': 'Cargando...'
          'sProcessing': 'Procesando...'
          'sSearch': 'Buscar:'
          'sZeroRecords': 'No se encontraron resultados'
          'oPaginate':
            'sFirst': 'Primero'
            'sLast': 'Último'
            'sNext': 'Siguiente'
            'sPrevious': 'Anterior'
          'oAria':
            'sSortAscending': ': activar para Ordenar Ascendentemente'
            'sSortDescending': ': activar para Ordendar Descendentemente'
      )

  		tabla.fnSort [[0,'desc']] if bsort

    return
