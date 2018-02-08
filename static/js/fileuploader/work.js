$('#fotoInput').fileuploader({
    // Options will go here
    extensions: ['jpg', 'jpeg', 'png', 'gif', 'bmp'],
    changeInput: ' ',
    theme: 'thumbnails',
    enableApi: true,
    addMore: true,
    thumbnails: {
        box: '<div class="fileuploader-items">' +
        '<ul class="fileuploader-items-list">' +
        '<li class="fileuploader-thumbnails-input"><div class="fileuploader-thumbnails-input-inner">+</div></li>' +
        '</ul>' +
        '</div>',
        item: '<li class="fileuploader-item">' +
        '<div class="fileuploader-item-inner">' +
        '<div class="thumbnail-holder">${image}</div>' +
        '<div class="actions-holder">' +
        '<a class="fileuploader-action fileuploader-action-remove" title="${captions.remove}"><i class="remove"></i></a>' +
        '<span class="fileuploader-action-popup"></span>' +
        '</div>' +
        '<div class="progress-holder">${progressBar}</div>' +
        '</div>' +
        '</li>',
        item2: '<li class="fileuploader-item">' +
        '<div class="fileuploader-item-inner">' +
        '<div class="thumbnail-holder">${image}</div>' +
        '<div class="actions-holder">' +
        '<a class="fileuploader-action fileuploader-action-remove" title="${captions.remove}"><i class="remove"></i></a>' +
        '<span class="fileuploader-action-popup"></span>' +
        '</div>' +
        '</div>' +
        '</li>',
        startImageRenderer: true,
        canvasImage: false,
        _selectors: {
            list: '.fileuploader-items-list',
            item: '.fileuploader-item',
            start: '.fileuploader-action-start',
            retry: '.fileuploader-action-retry',
            remove: '.fileuploader-action-remove'
        },
        onItemShow: function(item, listEl) {
            const plusInput = listEl.find('.fileuploader-thumbnails-input');

            plusInput.insertAfter(item.html);

            // add sorter button to the item html
            item.html.find('.fileuploader-action-remove').before('<a class="fileuploader-action fileuploader-action-sort" title="Sort"><i></i></a>');

            if(item.format === 'image') {
                item.html.find('.fileuploader-item-icon').hide();
            }
        },
        popup: {
            // popup HTML {String, Function}
            template: function (data) {
                return '<div class="fileuploader-popup">' +
                    '<div class="fileuploader-popup-preview">' +
                    '<div class="node ${format}">${reader.node}</div>' +
                    '<div class="tools">' +
                    '<ul>' +
                    '<li class="imageName">' +
                    '<span class="imageId" data-imageId="${name}">${captions.name}:</span>' +
                    '<h5>${name}</h5>' +
                    '</li>' +
                    // '<li class="imageSize">' +
                    // '<span>${captions.size}:</span>' +
                    // '<h5>${size}</h5>' +
                    // '</li>' +
                    (data.reader && data.reader.width ? '<li class="imagedimensions">' +
                            '<span>${captions.dimensions}:</span>' +
                            '<h5>${reader.width}x${reader.height}px</h5>' +
                            '</li>' : ''
                    ) +
                    (data.reader && data.reader.duration ? '<li>' +
                            '<span>${captions.duration}:</span>' +
                            '<h5>${reader.duration2}</h5>' +
                            '</li>' : ''
                    ) +
                    '<li id="forImageDefult" class="separator"></li>' +
                    '<li class="imageCheckDefault">' +
                        '<a id="setImageDefault" href="#">' +
                            '<i></i>' +
                            '<span>Обложка</span>' +
                        '</a>' +
                    '</li>'+
                    '<li class="separator"></li>' +
                    (data.format === 'image' && data.reader.src && data.editor ?
                            '<li class="imageCrop">' +
                            '<a data-action="crop">' +
                            '<i></i>' +
                            '<span>${captions.crop}</span>' +
                            '</a>' +
                            '</li>' +
                            '<li class="imageRotate">' +
                            '<a data-action="rotate-cw">' +
                            '<i></i>' +
                            '<span>${captions.rotate}</span>' +
                            '</a>' +
                            '</li>' : ''
                    ) +
                    '<li>' +
                    '<a data-action="remove">' +
                    '<i></i>' +
                    '<span>${captions.remove}</span>' +
                    '</a>' +
                    '</li>' +
                    '</ul>' +
                    '<div class="buttons">' +
                    '<a class="fileuploader-popup-button" data-action="cancel">${captions.cancel}</a>' +
                    '<a class="fileuploader-popup-button button-success" data-action="save">${captions.confirm}</a>' +
                    '</div>' +
                    '</div>' +
                    '</div>' +
                    '</div>';
            },
            onShow: function(item) {
                item.popup.html.on('click', '[data-action="crop"]', function(e) {
                    if (item.editor)
                        item.editor.cropper();
                }).on('click', '[data-action="rotate-cw"]', function(e) {
                    if (item.editor)
                        item.editor.rotate();
                }).on('click', '[data-action="remove"]', function(e) {
                    item.popup.close();
                    item.remove();
                }).on('click', '[data-action="cancel"]', function(e) {
                    item.popup.close();
                }).on('click', '[data-action="save"]', function(e) {
                    if (item.editor)
                        item.editor.save();
                    if (item.popup.close)
                        item.popup.close();
                });

                const div = item.image[0];
                if(div.classList.contains('isNew')) {
                    const imageDefaultItem = document.querySelector('.imageCheckDefault');
                    const separator = document.querySelector('#forImageDefult');

                    separator.style.display = 'none';
                    imageDefaultItem.style.display = 'none';
                }
            },
        },
    },
    afterRender: function(listEl, parentEl, newInputEl, inputEl) {
        const plusInput = listEl.find('.fileuploader-thumbnails-input'),
            api = $.fileuploader.getInstance(inputEl.get(0));

        plusInput.on('click', function() {
            api.open();
        });
    },
    onSelect: function(item, listEl, parentEl, newInputEl, inputEl) {
        item = item.image[0];
        item.classList.add('isNew');
    },
    editor: {
        // editor cropper
        cropper: {
            // cropper ratio
            // example: null
            // example: '1:1'
            // example: '16:9'
            // you can also write your own
            ratio: null,
            minWidth: null,
            minHeight: null,
            showGrid: true
        },

        // editor on save quality (0 - 100)
        // only front-end
        quality: null,
        maxWidth: null,
        maxHeight: null,

        // Callback fired after saving the image in editor
        onSave: function(blobOrDataUrl, item, listEl, parentEl, newInputEl, inputEl) {
            // callback will go here
        }
    },
    onRemove: function(item) {
        const workId = document.querySelector('.workId.hidden').getAttribute('data-workId');
        const imageId = item.name;
        const url = '/cabinet/work/' + workId + '/edit/removeImage/' + imageId;
        if (workId && url) {
            http(url).then(
                response => {
                    //todo make action if it will needed
                },
                onError => {
                    new Error('was an error (on delete image action): ' + onError.toString());
                }
            );
        }
    },
    sorter: {
        selectorExclude: null,
        placeholder: '<li class="fileuploader-item fileuploader-sorter-placeholder"><div class="fileuploader-item-inner"></div></li>',
        scrollContainer: window,
    },
    captions: {
        confirm: 'Ок',
        cancel: 'Отмена',
        name: 'Имя',
        type: 'Тип',
        size: 'Размер',
        dimensions: 'Пропорции',
        crop: 'Обрезать',
        rotate: 'Повернуть',
        download: 'Скачать',
        remove: 'Удалить',
        removeConfirmation: 'Вы действительно хотите удалить файл ?',
        errors: {
            filesLimit: 'Только ${limit} файлов может быть загружено.',
            filesType: 'Только ${extensions} файлы могут быть загружены.',
            fileSize: '${name} слишком большой! Выбирите фалй не более ${fileMaxSize}MB.',
            filesSizeAll: 'Файлы, которые вы выбрали, слишком велики! Пожалуйста, загрузите файлы до ${maxSize} MB.',
            fileName: 'Файл с именем ${name} уже выбран.',
            folderUpload: 'Вы не можете загружать папки.'
        }
    }
});

