Livewire.on('addPostScript', ()=>{
    var title = document.getElementById('title').value;
    var content = document.getElementById('content').value;

    if(title == ''){
        alert('Please enter your title.');
        document.getElementById('title').focus();
        document.getElementById('title').style.border = "1px solid red";
        return;
    }

    if(content == ''){
        alert('Please enter your content of post.');
        document.getElementById('content').focus();
        document.getElementById('content').style.border = "1px solid red";
        return;
    }

    Livewire.emit('addPost', title, content);
});

Livewire.on('resetPostScript', ()=>{
    document.getElementById('title').value = '';
    document.getElementById('content').value = '';

    setTimeout(function(){
        Livewire.emit('resetMessage');
    }, 5000);
});

Livewire.on('deletePostScript', id=>{
    var cFirm = confirm("Are you sure to delete this post? ");
    if(cFirm){
        Livewire.emit('deletePost', id);
    }
});

Livewire.on('getDataPostScript', id=>{
    var title = document.getElementById('title-' + id).value;
    var content = document.getElementById('content-' + id).value;

    document.getElementById('titleEdit').value = title;
    document.getElementById('contentEdit').value = content;
    document.getElementById('idEdit').value = id;

});

Livewire.on('editPostScript', ()=>{
    var id = document.getElementById('idEdit').value;
    var title = document.getElementById('titleEdit').value;
    var content = document.getElementById('contentEdit').value;

    if(title == ''){
        alert('Please enter your title.');
        document.getElementById('titleEdit').focus();
        document.getElementById('titleEdit').style.border = "1px solid red";
        return;
    }

    if(content == ''){
        alert('Please enter your content of post.');
        document.getElementById('contentEdit').focus();
        document.getElementById('contentEdit').style.border = "1px solid red";
        return;
    }

    Livewire.emit('editPost', id, title, content);
});


Livewire.on('publishPostScript', id=>{
    var cFirm = confirm('Are you sure to publish this post?');
    if(cFirm){
        Livewire.emit('publishPost', id);
    }
});
