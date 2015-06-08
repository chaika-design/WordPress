<?php
/**
 *  My_Category_Checklist
 *    template.php 内にある Walker_Category_Checklist を継承したCLASS
 *    投稿画面のカテゴリーの親カテゴリーのチェックボックスを表示しない
 *    投稿画面のカテゴリーのチェックボックスをラジオボタンに変更
 *  [cf.]
 *    http://liginc.co.jp/programmer/archives/4137
 */
require_once(ABSPATH . '/wp-admin/includes/template.php');

class My_Category_Checklist extends Walker_Category_Checklist {

  function start_el( &$output, $category, $depth = 0, $args = array(), $id = 0 ) {
    extract($args);
    if( empty($taxonomy) ) {
      $taxonomy = 'category';
    }
    if( $taxonomy == 'category' ) {
      $name = 'post_category';
    } else {
      $name = 'tax_input['.$taxonomy.']';
    }

    $class = in_array( $category->term_id, $popular_cats ) ? ' class="popular-category"' : '';
    // 親カテゴリの時はチェックボックス / ラジオボタンを表示しない
    // ※ 子カテゴリーがない場合もチェックボックスが消えてしまうので、子カテゴリーがある場合のみにラジオボタを表示させない
    $chaild_terms = get_term_children($category->term_id, $taxonomy);
    if( !empty( $chaild_terms ) ) {
      $output .= "\n<li id='{$taxonomy}-{$category->term_id}'$class>" .
        '<label class="selectit">' . esc_html( apply_filters('the_category', $category->name )) . '</label>';
    } else {
      $output .= "\n<li id='{$taxonomy}-{$category->term_id}'$class>" .
        '<label class="selectit"><input value="' . $category->term_id . '" type="radio" name="'.$name.'[]" id="in-'.$taxonomy.'-' . $category->term_id . '"' .
        checked( in_array( $category->term_id, $selected_cats ), true, false ) .
        disabled( empty( $args['disabled'] ), false, false ) . ' /> ' .
        esc_html( apply_filters('the_category', $category->name )) . '</label>';
    }
  }
}
?>
