<!-- Vendor JS Files -->
<script src="{{url('backend/assets/vendor/jquery/jquery.min.js')}}"></script>
<script src="{{url('backend/assets/vendor/apexcharts/apexcharts.min.js')}}"></script>
<script src="{{url('backend/assets/vendor/bootstrap/js/bootstrap.bundle.min.js')}}"></script>
<script src="{{url('backend/assets/vendor/chart.js/chart.umd.js')}}"></script>
<script src="{{url('backend/assets/vendor/echarts/echarts.min.js')}}"></script>
<script src="{{url('backend/assets/vendor/quill/quill.min.js')}}"></script>
<script src="{{url('backend/assets/vendor/simple-datatables/simple-datatables.js')}}"></script>
<script src="{{url('backend/assets/vendor/tinymce/tinymce.min.js')}}"></script>
<script src="{{url('backend/assets/vendor/php-email-form/validate.js')}}"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>


<!-- Bootstrap JavaScript -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
{{-- <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"
    integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous">
</script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/js/bootstrap.min.js"
    integrity="sha384-VHvPCCyXqtD5DqJeNxl2dtTyhF78xXNXdkwX1CZeRusQfRKp+tA7hAShOK/B/fQ2" crossorigin="anonymous">
</script> --}}


{{-- DataTable --}}
<script src="{{url('backend/assets/vendor/DataTables/datatables.min.js')}}"></script>
<script>
    $(document).ready(function(){
    })
    const resetNumber = () => {
        const childs = Array.from(document.querySelector("#data-table-search tbody").children)
        
        childs.forEach((child, i) => {
            const numberElement = child.firstElementChild;
            // if(numberElement.getAttribute('class') == 'dataTables_empty') return numberElement.innerHTML = "Tidak ada data yang ditemukan";
            if(numberElement.getAttribute('class') == 'dataTables_empty') return;
            numberElement.innerHTML = i + 1;
        })
    }
</script>

{{-- filter --}}
<script>
    const today = "{{date('Y-m-d')}}";
    const sessionTanggal = "{{ session('tanggal') }}";
    $(document).ready(function() {
        
        var tabel = $('#data-table').DataTable({
            dom: 'B<"sticky-wrapper"lf>rt<"sticky-wrapper"ip>'
        });
        // DataTable
        var tabel_cari = $('#data-table-search').DataTable({
            dom: 'B<"sticky-wrapper"lf>rt<"sticky-wrapper"ip>'
            // scrollX:true
            // initComplete: function () {
            //     let firstChild = document.createElement('div');
            //     let lastChild = document.createElement('div');
            //     let filter = document.querySelector('#data-table-search_filter')
            //     let length = document.querySelector('#data-table-search_length')
            //     let info = document.querySelector('#data-table-search_info')
            //     let paginate = document.querySelector('#data-table-search_paginate')

            //     let parent = document.querySelector('#data-table-search_wrapper')

            //     let flex = "d-flex justify-content-between align-items-center";
            //     let style = "position:sticky;left:0";
            //     firstChild.setAttribute("class", "mb-2 " + flex);
            //     firstChild.setAttribute("style", style);

            //     // firstChild.style.position = 'sticky';
            //     // firstChild.style.left = '0';
            //     firstChild.innerHTML = `<div class='${length.className}' id='${length.id}'>${length.innerHTML}</div><div class='${filter.className}' id='${filter.id}'>${filter.innerHTML}</div>`
            //     // firstChild.append(filter.target);
            //     // console.log({filter, firstChild});
            //     length.remove();
            //     filter.remove();
                
            //     lastChild.setAttribute("class", "mt-2 mb-2 " + flex);
            //     lastChild.setAttribute("style", style);
            //     lastChild.innerHTML = `<div class='${info.className}' id='${info.id}'>${info.innerHTML}</div><div class='${paginate.className}' id='${paginate.id}'>${paginate.innerHTML}</div>`;
            //     // info.remove();
            //     // paginate.remove();

            //     parent.insertBefore(firstChild, parent.firstChild)
            //     parent.appendChild(lastChild)
            // }
        });

        const btnToggle = document.querySelector(".toggle-sidebar-btn");
        if(btnToggle){
            btnToggle.onclick = function(){
                setTimeout(() => {
                    tabel_cari.draw()
                    tabel.draw()
                }, 300);
            }
        }

        const filters = document.querySelectorAll("#filter");
        if(filters.length > 0){
            filters.forEach(filter => {
                filter.onchange = function(){
                    const {search} = this.dataset
                    const table_row = Array.from(document.querySelector("#data-table-search thead tr").children)
                    
                    table_row.forEach((item, i) => {
                        if(String(item.dataset.search).toLowerCase() == String(search).toLowerCase()) 
                            return tabel_cari.columns(parseInt(i)).search(this.value).draw(); 
                        })
                    if(this.getAttribute('name') == 'tgl'){
                        const type = this.getAttribute('type');
                        if(typeof exportSetDate === 'function') exportSetDate(type == "date" ? this.value : today);
                        switch (type) {
                            case 'date':
                                reset('month', true)
                                break;
                            case 'month':
                                reset('date', true)
                                break;
                            default:
                                break;
                        }
                    }
                    resetNumber()
                }
            })
        }
        
        // set filter tgl hari ini
        const setTgl = (() => {
            const tgl = document.querySelector("#filter[data-search='tanggal']");
            if(tgl){
                tgl.value = sessionTanggal || today;
                tgl.dispatchEvent(new Event('change'))
                resetNumber()
            }
        })()
        
    })
</script>
<script defer>
    const reset = (id, init) => {
        const tglInput = document.querySelector(`input#filter[data-reset='${id}']`);
        if(tglInput){
            tglInput.value = ''
            if(!init){
                tglInput.dispatchEvent(new Event('change'))
            }
        }
    }
</script>

<!-- Template Main JS File -->
<script src="{{url('backend/assets/js/main.js')}}"></script>