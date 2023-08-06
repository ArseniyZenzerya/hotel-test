<?php

namespace App\Http\Controllers;

use App\Http\Requests\BookRequest;
use App\Models\Book;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;

class BookController
{
    /**
     * @param Request $request
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function addBook(BookRequest $request){
        $data = $request->all();

        $bookedPeriods = Book::where('status','active')->select('check_in', 'check_out')->get();

        $selectedCheckIn = Carbon::parse($data['check_in']);
        $selectedCheckOut = Carbon::parse($data['check_out']);


        foreach ($bookedPeriods as $bookedPeriod) {
            $bookedCheckIn = Carbon::parse($bookedPeriod->check_in);
            $bookedCheckOut = Carbon::parse($bookedPeriod->check_out);

            if (
                ($selectedCheckIn >= $bookedCheckIn && $selectedCheckIn <= $bookedCheckOut) ||
                ($selectedCheckOut >= $bookedCheckIn && $selectedCheckOut <= $bookedCheckOut) ||
                ($selectedCheckIn <= $bookedCheckIn && $selectedCheckOut >= $bookedCheckOut)
            ) {
                return redirect()->back()->with('error', 'Вибраний період перетинається із заброньованим.');
            }
            if ($selectedCheckIn > $selectedCheckOut) {
                return redirect()->back()->with('error', 'Виберіть правильний період.');
            }
        }

        $admin_type = $request->input('admin_type');
        unset($data['admin_type']);

        $data['check_in'] = \DateTime::createFromFormat('d.m.Y', $data['check_in'])->format('Y-m-d');
        $data['check_out'] = \DateTime::createFromFormat('d.m.Y', $data['check_out'])->format('Y-m-d');
        $data['tel'] = Crypt::encryptString($data['tel']);
        Book::create($data);

        if ($admin_type) {
            $route = 'admin.dashboard';
        } else {
            $route = 'home';
        }
        return redirect(route($route))->with('success', 'Запис доданий успішно.');

    }


    /**
     * @return \Illuminate\Http\JsonResponse
     */
    public function getDates(){
        $bookedPeriods = Book::where('status', 'active')->select('check_in', 'check_out')->get();

        $allDates = [];

        foreach ($bookedPeriods as $bookedPeriod) {
            $checkIn = Carbon::parse($bookedPeriod->check_in);
            $checkOut = Carbon::parse($bookedPeriod->check_out);

            $datesInRange = $this->getDatesInRange($checkIn, $checkOut);
            $allDates = array_merge($allDates, $datesInRange);
        }

        return response()->json(['dates' => $allDates]);
    }

    /**
     * @param $start
     * @param $end
     * @return array
     */
    private function getDatesInRange($start, $end) {
        $dates = [];
        $current = $start->copy();

        while ($current->lte($end)) {
            $dates[] = $current->format('Y-m-d');
            $current->addDay();
        }

        return $dates;
    }

    /**
     * @param Request $request
     * @return void
     */
    public function changeBook(Request $request){
        $data = $request->all();
        $book = Book::find($data['bookId']);

        $book->update([
            'status' => $data['status'],
        ]);
    }

    /**
     * @param Request $request
     * @return void
     */
    public function deleteBook(Request $request){
        $data = $request->all();
        $book = Book::find($data['bookId']);
        $book->delete();
    }
}
