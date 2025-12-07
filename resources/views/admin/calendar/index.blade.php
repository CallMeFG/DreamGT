@extends('layouts.app')

@section('content')
    <script src='https://cdn.jsdelivr.net/npm/fullcalendar@6.1.10/index.global.min.js'></script>

    <div class="min-h-full bg-gray-50 w-full p-8 md:p-12">

        <div class="flex justify-between items-end mb-8">
            <div>
                <h1 class="text-3xl font-black text-ewc-black uppercase tracking-tighter">Schedule Visualizer</h1>
                <p class="text-sm text-gray-500 mt-1">Calendar view for PC & Arena bookings.</p>
            </div>

            <div class="flex gap-4">
                <div class="flex items-center gap-2">
                    <span class="w-3 h-3 bg-black rounded-sm"></span>
                    <span class="text-xs font-bold uppercase text-gray-600">PC Booking</span>
                </div>
                <div class="flex items-center gap-2">
                    <span class="w-3 h-3 bg-ewc-gold rounded-sm"></span>
                    <span class="text-xs font-bold uppercase text-gray-600">Arena Booking</span>
                </div>
            </div>
        </div>

        <div class="bg-white p-6 rounded-xl border border-gray-200 shadow-sm">
            <div id='calendar' class="min-h-[700px]"></div>
        </div>

    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            var calendarEl = document.getElementById('calendar');

            // Ambil data event dari Controller (Blade to JS)
            var bookings = @json($events);

            var calendar = new FullCalendar.Calendar(calendarEl, {
                initialView: 'timeGridWeek', // Tampilan Default: Mingguan dengan Jam
                headerToolbar: {
                    left: 'prev,next today',
                    center: 'title',
                    right: 'dayGridMonth,timeGridWeek,timeGridDay'
                },
                slotMinTime: '08:00:00', // Jam mulai tampilan (08 pagi)
                slotMaxTime: '24:00:00', // Jam selesai tampilan
                events: bookings,        // Load data
                nowIndicator: true,      // Garis merah jam sekarang
                allDaySlot: false,       // Hilangkan slot "sepanjang hari"
                height: 'auto',

                // Styling Custom saat event di-render
                eventDidMount: function (info) {
                    // Tambahkan Tooltip sederhana (Title saat hover)
                    info.el.title = info.event.title + " (" + info.event.extendedProps.status + ")";
                }
            });

            calendar.render();
        });
    </script>

    <style>
        /* Ubah warna header dan tombol */
        .fc-button-primary {
            background-color: #0a0a0a !important;
            border-color: #0a0a0a !important;
            text-transform: uppercase;
            font-weight: bold;
            font-size: 0.75rem !important;
            letter-spacing: 0.05em;
        }

        .fc-button-primary:hover {
            background-color: #fbbf24 !important;
            /* Gold on hover */
            border-color: #fbbf24 !important;
            color: #000 !important;
        }

        .fc-toolbar-title {
            font-family: 'Inter', sans-serif;
            font-weight: 900 !important;
            text-transform: uppercase;
            font-size: 1.5rem !important;
        }

        .fc-col-header-cell-cushion {
            color: #0a0a0a;
            text-decoration: none !important;
            text-transform: uppercase;
            font-size: 0.8rem;
        }

        .fc-timegrid-slot-label-cushion {
            font-size: 0.75rem;
            font-weight: bold;
        }
    </style>
@endsection