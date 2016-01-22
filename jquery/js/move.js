$(document).ready(function () {
  var _this = null;
  var divoffset = $('#move_div').offset();
  var _topLimit = 0; //变换样式使用
  var _leftLimit = divoffset.left; //限制鼠标的移动范围
  var _rightLimit = _leftLimit + 120;
  var _bottomLimit = 0;
  var _top = divoffset.top;
  var _bottom = _top + 250;
  var bottomoffset = $('#move_bottom').offset;
  _topLimit = divoffset.top;
  _bottomLimit = _topLimit + 140;
  var top_pos_arr = new Array();
  var bottom_pos_arr = new Array();
  $('#move_top').find('span').each(function (index, element) {
    var span_pos = $(this).offset();
    top_pos_arr.push(span_pos);
  });
  $('#move_bottom').find('span').each(function (index, element) {
    var span_pos_b = $(this).offset();
    bottom_pos_arr.push(span_pos_b);
  });
  $('.span_move').mousedown(function (e) {
    _this = $(this);
    var spanpos = 'top'; //标记当前span 的位置 上 下
    // $(this).css({"cursor":"move"});
    //下方的标题块
    if ($(this).hasClass('bottom_span')) {
      spanpos = 'bottom';
    } else if ($(this).hasClass('top_span')) {
      spanpos = 'top';
    }
    var offset = $(this).offset();
    var x = parseInt(e.pageX - offset.left);
    var y = parseInt(e.pageY - offset.top);
    var _this_sort = $(this).attr('sort');
    $(document).bind('mousemove', function (em) {
      $('.span_move').stop();
      _this.css('opacity', '0.5');
      if (_this.hasClass('bottom_span')) {
        span_pos = 'bottom';
      } else if (_this.hasClass('top_span')) {
        span_pos = 'top';
      }
      var _x = parseInt(em.pageX - x);
      var _y = parseInt(em.pageY - x);
      //自动对齐
      for (var i = 0; i < top_pos_arr.length; i++) {
        var ele_left = top_pos_arr[i].left;
        var ele_top = top_pos_arr[i].top;
        var target_right = ele_left + 20;
        var target_bottom = ele_top + 10;
        if (_x >= ele_left && _x <= target_right && _y <= target_bottom && _y >= ele_top) {
          _x = ele_left;
          _y = ele_top;
        }
      }
      for (var j = 0; j < bottom_pos_arr.length; j++) {
        var b_ele_left = bottom_pos_arr[j].left;
        var b_ele_top = bottom_pos_arr[j].top;
        var b_target_right = b_ele_left + 20;
        var b_target_bottom = b_ele_top + 10;
        if (_x >= b_ele_left && _x <= b_target_right && _y >= b_ele_top && _y <= b_target_bottom) {
          _x = b_ele_left;
          _y = b_ele_top;
        }
      }
      //限定位置

      if (_x >= _rightLimit) {
        _x = _rightLimit;
      } else if (_x <= _leftLimit) {
        _x = _leftLimit;
      }
      if (_y >= _bottom) {
        _y = _bottom;
      } else if (_y <= _top) {
        _y = _top;
      }
      //修改样式

      if (spanpos == 'top') {
        if (_y >= _bottomLimit) {
          _this.removeClass('top_span');
          _this.addClass('bottom_span');
        } else {
          _this.removeClass('bottom_span');
          _this.addClass('top_span');
        }
      } else if (spanpos == 'bottom') {
        if (_y <= _bottomLimit) {
          _this.removeClass('bottom_span');
          _this.addClass('top_span');
        } else {
          _this.removeClass('top_span');
          _this.addClass('bottom_span');
        }
      }
      //鼠标拖动动画

      _this.animate({
        left: _x + 'px',
        top: _y + 'px'
      }, 100);
      //重新定义位置
      var _target_sort = 0;
      var _target_x = 0;
      var _target_y = 0;
      //向前拖动
      if (_x <= offset.left && _y <= offset.top) {
        $('#move_top').find('span').each(function (index, element) {
          var _cur_sort = $(this).attr('sort');
          var _cur_left = $(this).offset().left;
          var _cur_top = $(this).offset().top;
          if (_x == _cur_left && _y == _cur_top) {
            _target_sort = _cur_sort;
            _target_x = _cur_left;
            _target_y = _cur_top;
          }
        });
        if (_x == _target_x && _y == _target_y) {
    
          _this.stop();
          $('#move_top').find('span').each(function (index, element) {
            var _cur_sort = $(this).attr('sort');
            if (_cur_sort >= _target_sort && _cur_sort < _this_sort) {
              var _cur_index = parseInt(_cur_sort);
              var _next_index = ++_cur_index;
              var _next_pos = top_pos_arr[_next_index];
              $(this).offset({
                left: _next_pos.left,
                top: _next_pos.top
              });
              $(this).attr('sort', _next_index);
            }
          });
          _this.attr('sort', _target_sort);
        }
      } // 向上拖动 结束
      //向下拖动

      if(_x>=offset.left && _y>=offset.top){
        _this.css("z-index","100");
        $("#move_top").find("span").each(function(index,element){
          var _cur_sort = $(this).attr("sort");
          var _cur_left = $(this).offset().left;
          var _cur_top = $(this).offset().top;
          if(_x==_cur_left && _y==_cur_top){
            _target_x = _x;
            _target_y = _y;
            _target_sort = _cur_sort;
          }
        });
        if(_x == _target_x && _y==_target_y){

          $(this).stop();
          $("#move_top").find("span").each(function(index,element){
            var _cur_sort = $(this).attr("sort");
            if(_cur_sort >= _this_sort && _cur_sort <= _target_sort){
              var _cur_index = parseInt(_cur_sort);
              var _pre_index = --_cur_index;
              var _pre_pos = top_pos_arr[_pre_index];
              $(this).offset({
                left:_pre_pos.left,
                top:_pre_pos.top
              });
              $(this).attr("sort",_pre_index);
            }
          });
          _this.attr("sort",_target_sort);
        }
      } //向下拖动 结束
      
    });
  });
  $(document).mouseup(function ()
  {
    $('.span_move').css('cursor', 'default');
    _this.css('opacity', '1.0');
    $(this).unbind('mousemove');
  })
});
