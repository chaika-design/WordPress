!function($) {
  if(inlineEditPost && inlineEditPost.edit) {
    var _Edit = inlineEditPost.edit;
    inlineEditPost.edit = function(id) {
      // 元の edit の処理を行う
      _Edit.apply(inlineEditPost, arguments);
      var t = this, rowData, editRow;
      if ( typeof(id) === 'object' ) {
        id = this.getId(id);
      }
      // 編集エリアは既にcloneされているものを取得
      editRow = $('#edit-'+id);
      rowData = $('#inline_'+id);
      // hierarchical taxonomies
      $('.post_category', rowData).each(function(){
        var $t = $(this),
            taxname,
            term_ids = $t.text();
        if ( term_ids ) {
          taxname = $t.attr('id').replace('_'+id, '');
          $('ul.'+taxname+'-checklist :radio', editRow).val(term_ids.split(','));
        }
      });

      return false;
    };
  }
}(jQuery);
