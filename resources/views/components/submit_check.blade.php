<script>
  function submitCheck(flagType) {
    let flagString = '';
    if (flagType == 'delete') {
      flagString = "削除してもよろしいですか？\n\n削除しない場合は[キャンセル]ボタンを押して下さい";
    } else {
      flagString = "送信してもよろしいですか？\n\n送信したくない場合は[キャンセル]ボタンを押して下さい";
    }
    const flag = confirm(flagString);
    /* send_flg が TRUEなら送信、FALSEなら送信しない */
    return flag;
  }

</script>
