function page2pdf(contentClass) {
    domtoimage.toPng(document.getElementsByClassName(contentClass)[0]).then(function (blob) {
        var pdf = new jsPDF('l', 'pt', [$('.' + contentClass).width(), $('.' + contentClass).height()]);
        pdf.addImage(blob, 'PNG', 0, 0, $('.' + contentClass).width(), $('.' + contentClass).height());
        pdf.save('هيئة الصحفيين السعوديين.pdf');
    });
}
