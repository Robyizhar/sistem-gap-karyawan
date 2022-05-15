<div class="text-center">
    @if (isset($url_show) && (Auth::user()->getRoleNames()[0] == 'Developer' || Auth::user()->hasAnyPermission(['View-'.$menu])))
        <a href="{{ $url_show }}" class="btn-show btn btn-sm btn-round btn-icon icon-left btn-transparent" title="Detail">
            <span class="svg-icon svg-icon-2 m-0">
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="15" viewBox="0 0 16 15" fill="none">
                    <rect y="6" width="16" height="3" rx="1.5" fill="black"></rect>
                    <rect opacity="0.3" y="12" width="8" height="3" rx="1.5" fill="black"></rect>
                    <rect opacity="0.3" width="12" height="3" rx="1.5" fill="black"></rect>
                </svg>
            </span>
        </a>
    @endif
    @if (isset($url_build))
        <a href="{{ $url_build }}" class="btn btn-sm btn-round btn-icon btn-transparent" title="Build Menu">
            <span class="svg-icon svg-icon-3">
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                    <path opacity="0.3" d="M22.0318 8.59998C22.0318 10.4 21.4318 12.2 20.0318 13.5C18.4318 15.1 16.3318 15.7 14.2318 15.4C13.3318 15.3 12.3318 15.6 11.7318 16.3L6.93177 21.1C5.73177 22.3 3.83179 22.2 2.73179 21C1.63179 19.8 1.83177 18 2.93177 16.9L7.53178 12.3C8.23178 11.6 8.53177 10.7 8.43177 9.80005C8.13177 7.80005 8.73176 5.6 10.3318 4C11.7318 2.6 13.5318 2 15.2318 2C16.1318 2 16.6318 3.20005 15.9318 3.80005L13.0318 6.70007C12.5318 7.20007 12.4318 7.9 12.7318 8.5C13.3318 9.7 14.2318 10.6001 15.4318 11.2001C16.0318 11.5001 16.7318 11.3 17.2318 10.9L20.1318 8C20.8318 7.2 22.0318 7.59998 22.0318 8.59998Z" fill="black"/>
                    <path d="M4.23179 19.7C3.83179 19.3 3.83179 18.7 4.23179 18.3L9.73179 12.8C10.1318 12.4 10.7318 12.4 11.1318 12.8C11.5318 13.2 11.5318 13.8 11.1318 14.2L5.63179 19.7C5.23179 20.1 4.53179 20.1 4.23179 19.7Z" fill="black"/>
                </svg>
            </span>
        </a>
    @endif
    @if (isset($url_edit) && (Auth::user()->getRoleNames()[0] == 'Developer' || Auth::user()->hasAnyPermission(['Edit-'.$menu])))
        <a href="{{ $url_edit }}" class="modal-show edit btn btn-sm btn-round btn-icon icon-left btn-transparent" title="Edit">
            <span class="svg-icon svg-icon-3">
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                    <path opacity="0.3" d="M21.4 8.35303L19.241 10.511L13.485 4.755L15.643 2.59595C16.0248 2.21423 16.5426 1.99988 17.0825 1.99988C17.6224 1.99988 18.1402 2.21423 18.522 2.59595L21.4 5.474C21.7817 5.85581 21.9962 6.37355 21.9962 6.91345C21.9962 7.45335 21.7817 7.97122 21.4 8.35303ZM3.68699 21.932L9.88699 19.865L4.13099 14.109L2.06399 20.309C1.98815 20.5354 1.97703 20.7787 2.03189 21.0111C2.08674 21.2436 2.2054 21.4561 2.37449 21.6248C2.54359 21.7934 2.75641 21.9115 2.989 21.9658C3.22158 22.0201 3.4647 22.0084 3.69099 21.932H3.68699Z" fill="black" />
                    <path d="M5.574 21.3L3.692 21.928C3.46591 22.0032 3.22334 22.0141 2.99144 21.9594C2.75954 21.9046 2.54744 21.7864 2.3789 21.6179C2.21036 21.4495 2.09202 21.2375 2.03711 21.0056C1.9822 20.7737 1.99289 20.5312 2.06799 20.3051L2.696 18.422L5.574 21.3ZM4.13499 14.105L9.891 19.861L19.245 10.507L13.489 4.75098L4.13499 14.105Z" fill="black" />
                </svg>
            </span>
        </a>
    @endif
    @if (isset($url_destroy) && (Auth::user()->getRoleNames()[0] == 'Developer' || Auth::user()->hasAnyPermission(['Delete-'.$menu])))
        <a href="{{ $url_destroy }}" class="btn-delete btn btn-sm btn-round btn-icon icon-left btn-transparent" title="Hapus">
            <span class="svg-icon svg-icon-3">
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                    <path d="M5 9C5 8.44772 5.44772 8 6 8H18C18.5523 8 19 8.44772 19 9V18C19 19.6569 17.6569 21 16 21H8C6.34315 21 5 19.6569 5 18V9Z" fill="black" />
                    <path opacity="0.5" d="M5 5C5 4.44772 5.44772 4 6 4H18C18.5523 4 19 4.44772 19 5V5C19 5.55228 18.5523 6 18 6H6C5.44772 6 5 5.55228 5 5V5Z" fill="black" />
                    <path opacity="0.5" d="M9 4C9 3.44772 9.44772 3 10 3H14C14.5523 3 15 3.44772 15 4V4H9V4Z" fill="black" />
                </svg>
            </span>
        </a>
    @endif
    @if (isset($detail_promosi) && (Auth::user()->getRoleNames()[0] == 'Developer' || Auth::user()->hasAnyPermission(['View-'.$menu])))
        <a
            href="#"
            data-np="{{ $detail_promosi->np }}"
            data-nama_lengkap="{{ $detail_promosi->nama_lengkap }}"
            data-nama_level="{{ $detail_promosi->nama_level }}"
            data-nama_jabatan="{{ $detail_promosi->nama_jabatan }}"
            data-nama_pangkat="{{ $detail_promosi->nama_pangkat }}"
            data-nama_unit="{{ $detail_promosi->nama_unit }}"

            data-waktu_penilaian="{{ $detail_promosi->waktu_penilaian }}"
            data-nilai_kedisiplinan="{{ $detail_promosi->nilai_kedisiplinan }}"
            data-nilai_kepatuhan="{{ $detail_promosi->nilai_kepatuhan }}"
            data-nilai_sikap_kerja="{{ $detail_promosi->nilai_sikap_kerja }}"
            data-nilai_inisiatif="{{ $detail_promosi->nilai_inisiatif }}"
            data-persentase="{{ $detail_promosi->persentase }}"
            data-keterangan_hukuman="{{ $detail_promosi->keterangan_hukuman }}"
            data-keyword="{{ $detail_promosi->keyword }}"

            data-file_sertifikasi="{{ $detail_promosi->file_sertifikasi }}"
            data-no_sertifikasi="{{ $detail_promosi->no_sertifikasi }}"
            data-penilaian_karyawan_id="{{ $detail_promosi->penilaian_karyawan_id }}"

            data-id="{{ $detail_promosi->id }}"
            data-id_jabatan="{{ $detail_promosi->id_jabatan }}"
            data-id_unit="{{ $detail_promosi->id_unit }}"

            data-id_level="{{ $detail_promosi->id_level }}"
            data-id_pangkat="{{ $detail_promosi->id_pangkat }}"
            data-id_karyawan="{{ $detail_promosi->id_karyawan }}"
            data-tmt_jabatan="{{ date("Y-m-d", strtotime($detail_promosi->tmt_jabatan)) }}"

            data-toggle="modal" data-target="#full-width-modal"
            class="btn-show btn btn-sm btn-round btn-icon icon-left btn-transparent detail_promosi" title="Detail">
            <span class="svg-icon svg-icon-2 m-0">
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="15" viewBox="0 0 16 15" fill="none">
                    <rect y="6" width="16" height="3" rx="1.5" fill="black"></rect>
                    <rect opacity="0.3" y="12" width="8" height="3" rx="1.5" fill="black"></rect>
                    <rect opacity="0.3" width="12" height="3" rx="1.5" fill="black"></rect>
                </svg>
            </span>
        </a>
    @endif
</div>

{{-- // "id": null,
// "penilaian_karyawan_id": 2,
// "unit_id": null,
// "jabatan_id": null,
// "new_jabatan_id": null, --}}
