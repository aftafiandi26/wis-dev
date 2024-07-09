<?php

namespace App\Http\Controllers;

use App\Leave;
use App\User;
use Datatables;

use Illuminate\Http\Request;

use Maatwebsite\Excel\Facades\Excel;

class HRLeaveSummaryChartController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth', 'active', 'hr']);
    }

    public function index(Request $request)
    {
        $chartCountAnnual = null;
        $chartCountExdo = null;
        $chartCountEtc = null;

        if ($request->input('leave_id') === "6") {
            $chartCountAnnual = $this->getObjectDataProvinsiForProductionAnnual($request->all());
            $chartCountExdo = $this->getObjectDataProvinsiForProductionExdo($request->all());
            $chartCountEtc = $this->getObjectDataProvinsiForProductionEtc($request->all());

            $query = Leave::where('ap_hrd', 1)->whereBetween('leave_date', [$request->input('makeStart'), $request->input('maekEnd')])->whereIn('leave_category_id', [1, 2])->whereIn('request_dept_category_name', ['Production'])->orderBy('leave_date', 'asc')->paginate(10);
        } else {
            $chartCountAnnual = $this->getObjectDataProvinsiForOfficerAnnual($request->all());
            $chartCountExdo = $this->getObjectDataProvinsiForOfficerExdo($request->all());
            $chartCountEtc = $this->getObjectDataProvinsiForOfficerEtc($request->all());

            $query = Leave::where('ap_hrd', 1)->whereBetween('leave_date', [$request->input('makeStart'), $request->input('maekEnd')])->whereIn('leave_category_id', [1, 2])->whereNotIn('request_dept_category_name', ['Production'])->orderBy('leave_date', 'asc')->paginate(10);
        }

        $chartNameMonth = $this->dataProvinsi();

        $sumateraIsland = $this->sumateraIsland($chartCountAnnual);
        $javaIsland = $this->javaIsland($chartCountAnnual);
        $kalimantanIsland = $this->kalimantanIsland($chartCountAnnual);
        $nusantaraIsland = $this->nusantaraIsland($chartCountAnnual);
        $sulawesiIsland = $this->sulawesiIsland($chartCountAnnual);

        $sumateraIsland1 = $this->sumateraIsland($chartCountExdo);
        $javaIsland1 = $this->javaIsland($chartCountExdo);
        $kalimantanIsland1 = $this->kalimantanIsland($chartCountExdo);
        $nusantaraIsland1 = $this->nusantaraIsland($chartCountExdo);
        $sulawesiIsland1 = $this->sulawesiIsland($chartCountExdo);



        return view('HRDLevelAcces.leave.summary.chart.index', compact([
            'chartCountAnnual',
            'chartCountExdo',
            'chartCountEtc',
            'chartNameMonth',
            'request',
            'query',
            'sumateraIsland',
            'javaIsland',
            'kalimantanIsland',
            'nusantaraIsland',
            'sulawesiIsland',
            'sumateraIsland1',
            'javaIsland1',
            'kalimantanIsland1',
            'nusantaraIsland1',
            'sulawesiIsland1',
        ]));
    }

    public function dataObjectIndex(Request $request)
    {
        $query = Leave::whereBetween('leave_date', [$request['makeStart'], $request['maekEnd']])->where('leave_category_id', $request['selectChart'])->limit(10)->get();

        return Datatables::of($query)
            ->addIndexColumn()
            ->editColumn('leave_category_id', function (Leave $leave) {
                return $leave->getLeaveCategory();
            })
            ->editColumn('request_by', function (Leave $leave) {
                $return = User::find($leave->user_id);

                return $return->getFullName();
            })
            ->make(true);
    }

    private function sumateraIsland(array $amount)
    {
        $result = $amount['aceh'] + $amount['sumut'] + $amount['sumbar'] + $amount['riau'] + $amount['jambi'] + $amount['sumsel'] + $amount['bengkulu'] + $amount['lampung'] + $amount['bangka'] + $amount['kepri'];

        return $result;
    }

    private function javaIsland(array $amount)
    {
        $result = $amount['dki'] + $amount['jabar'] + $amount['jateng'] + $amount['yogya'] + $amount['jatim'] + $amount['banten'];

        return $result;
    }

    private function kalimantanIsland(array $amount)
    {
        $result = $amount['kalbar'] + $amount['kalteng'] + $amount['kalsel'] + $amount['kaltim'] + $amount['kalut'];

        return $result;
    }

    private function nusantaraIsland(array $amount)
    {
        $result = $amount['ntt'] + $amount['ntb'];
        return $result;
    }

    private function sulawesiIsland(array $amount)
    {
        $result = $amount['sulut'] + $amount['sulteng'] + $amount['sulsel'] + $amount['sultengga'] + $amount['goro'] + $amount['sulbar'];
        return $result;
    }

    private function dataProvinsi()
    {
        $result = [
            "aceh" => "Aceh",
            "sumut" => "Sumatera Utara",
            "sumbar" => "Sumatera Barat",
            "riau" => "Riau",
            "jambi" => "Jambi",
            "sumsel" => "Sumatera Selatan",
            "bengkulu" => "Bengkulu",
            "lampung" => "Lampung",
            "bangka" => "Kepulauan Bangka Belitung",
            "kepri" => "Kepulauan Riau",
            "dki" => "Dki Jakarta",
            "jabar" => "Jawa Barat",
            "jateng" => "Jawa Tengah",
            "yogya" => "Di Yogyakarta",
            "jatim" => "Jawa Timur",
            "banten" => "Banten",
            "bali" => "Bali",
            "ntb" => "Nusa Tenggara Barat",
            "ntt" => "Nusa Tenggara Timur",
            "kalbar" => "Kalimantan Barat",
            "kalteng" => "Kalimantan Tengah",
            "kalsel" => "Kalimantan Selatan",
            "kaltim" => "Kalimantan Timur",
            "kalut" => "Kalimantan Utara",
            "sulut" => "Sulawesi Utara",
            "sulteng" => "Sulawesi Tengah",
            "sulsel" => "Sulawesi Selatan",
            "sultengga" => "Sulawesi Tenggara",
            "goro" => "Gorontalo",
            "sulbar" => "Sulawesi Barat",
            "maluku" => "Maluku",
            "malut" => "Maluku Utara",
            "papuabar" => "Papua Barat",
            "papua" => "Papua",
        ];
        return $result;
    }

    private function getObjectDataProvinsiForProductionAnnual($request)
    {
        $data = $this->dataProvinsi();

        $aceh = Leave::where('ap_hrd', 1)->where('r_departure', $data['aceh'])->whereBetween('leave_date', [$request['makeStart'], $request['maekEnd']])->where('leave_category_id', 1)->whereIn('request_dept_category_name', ['Production'])->get()->count();
        $sumut = Leave::where('ap_hrd', 1)->where('r_departure', $data['sumut'])->whereBetween('leave_date', [$request['makeStart'], $request['maekEnd']])->where('leave_category_id', 1)->whereIn('request_dept_category_name', ['Production'])->get()->count();
        $sumbar = Leave::where('ap_hrd', 1)->where('r_departure', $data['sumbar'])->whereBetween('leave_date', [$request['makeStart'], $request['maekEnd']])->where('leave_category_id', 1)->whereIn('request_dept_category_name', ['Production'])->get()->count();
        $riau = Leave::where('ap_hrd', 1)->where('r_departure', $data['riau'])->whereBetween('leave_date', [$request['makeStart'], $request['maekEnd']])->where('leave_category_id', 1)->whereIn('request_dept_category_name', ['Production'])->get()->count();
        $jambi = Leave::where('ap_hrd', 1)->where('r_departure', $data['jambi'])->whereBetween('leave_date', [$request['makeStart'], $request['maekEnd']])->where('leave_category_id', 1)->whereIn('request_dept_category_name', ['Production'])->get()->count();
        $sumsel = Leave::where('ap_hrd', 1)->where('r_departure', $data['sumsel'])->whereBetween('leave_date', [$request['makeStart'], $request['maekEnd']])->where('leave_category_id', 1)->whereIn('request_dept_category_name', ['Production'])->get()->count();
        $bengkulu = Leave::where('ap_hrd', 1)->where('r_departure', $data['bengkulu'])->whereBetween('leave_date', [$request['makeStart'], $request['maekEnd']])->where('leave_category_id', 1)->whereIn('request_dept_category_name', ['Production'])->get()->count();
        $lampung = Leave::where('ap_hrd', 1)->where('r_departure', $data['lampung'])->whereBetween('leave_date', [$request['makeStart'], $request['maekEnd']])->where('leave_category_id', 1)->whereIn('request_dept_category_name', ['Production'])->get()->count();
        $bangka = Leave::where('ap_hrd', 1)->where('r_departure', $data['bangka'])->whereBetween('leave_date', [$request['makeStart'], $request['maekEnd']])->where('leave_category_id', 1)->whereIn('request_dept_category_name', ['Production'])->get()->count();
        $kepri = Leave::where('ap_hrd', 1)->where('r_departure', $data['kepri'])->whereBetween('leave_date', [$request['makeStart'], $request['maekEnd']])->where('leave_category_id', 1)->whereIn('request_dept_category_name', ['Production'])->get()->count();
        $dki = Leave::where('ap_hrd', 1)->where('r_departure', $data['dki'])->whereBetween('leave_date', [$request['makeStart'], $request['maekEnd']])->where('leave_category_id', 1)->whereIn('request_dept_category_name', ['Production'])->get()->count();
        $jabar = Leave::where('ap_hrd', 1)->where('r_departure', $data['jabar'])->whereBetween('leave_date', [$request['makeStart'], $request['maekEnd']])->where('leave_category_id', 1)->whereIn('request_dept_category_name', ['Production'])->get()->count();
        $jateng = Leave::where('ap_hrd', 1)->where('r_departure', $data['jateng'])->whereBetween('leave_date', [$request['makeStart'], $request['maekEnd']])->where('leave_category_id', 1)->whereIn('request_dept_category_name', ['Production'])->get()->count();
        $yogya = Leave::where('ap_hrd', 1)->where('r_departure', $data['yogya'])->whereBetween('leave_date', [$request['makeStart'], $request['maekEnd']])->where('leave_category_id', 1)->whereIn('request_dept_category_name', ['Production'])->get()->count();
        $jatim = Leave::where('ap_hrd', 1)->where('r_departure', $data['jatim'])->whereBetween('leave_date', [$request['makeStart'], $request['maekEnd']])->where('leave_category_id', 1)->whereIn('request_dept_category_name', ['Production'])->get()->count();
        $banten = Leave::where('ap_hrd', 1)->where('r_departure', $data['banten'])->whereBetween('leave_date', [$request['makeStart'], $request['maekEnd']])->where('leave_category_id', 1)->whereIn('request_dept_category_name', ['Production'])->get()->count();
        $bali = Leave::where('ap_hrd', 1)->where('r_departure', $data['bali'])->whereBetween('leave_date', [$request['makeStart'], $request['maekEnd']])->where('leave_category_id', 1)->whereIn('request_dept_category_name', ['Production'])->get()->count();
        $ntb = Leave::where('ap_hrd', 1)->where('r_departure', $data['ntb'])->whereBetween('leave_date', [$request['makeStart'], $request['maekEnd']])->where('leave_category_id', 1)->whereIn('request_dept_category_name', ['Production'])->get()->count();
        $ntt = Leave::where('ap_hrd', 1)->where('r_departure', $data['ntt'])->whereBetween('leave_date', [$request['makeStart'], $request['maekEnd']])->where('leave_category_id', 1)->whereIn('request_dept_category_name', ['Production'])->get()->count();
        $kalbar = Leave::where('ap_hrd', 1)->where('r_departure', $data['kalbar'])->whereBetween('leave_date', [$request['makeStart'], $request['maekEnd']])->where('leave_category_id', 1)->whereIn('request_dept_category_name', ['Production'])->get()->count();
        $kalteng = Leave::where('ap_hrd', 1)->where('r_departure', $data['kalteng'])->whereBetween('leave_date', [$request['makeStart'], $request['maekEnd']])->where('leave_category_id', 1)->whereIn('request_dept_category_name', ['Production'])->get()->count();
        $kalsel = Leave::where('ap_hrd', 1)->where('r_departure', $data['kalsel'])->whereBetween('leave_date', [$request['makeStart'], $request['maekEnd']])->where('leave_category_id', 1)->whereIn('request_dept_category_name', ['Production'])->get()->count();
        $kaltim = Leave::where('ap_hrd', 1)->where('r_departure', $data['kaltim'])->whereBetween('leave_date', [$request['makeStart'], $request['maekEnd']])->where('leave_category_id', 1)->whereIn('request_dept_category_name', ['Production'])->get()->count();
        $kalut = Leave::where('ap_hrd', 1)->where('r_departure', $data['kalut'])->whereBetween('leave_date', [$request['makeStart'], $request['maekEnd']])->where('leave_category_id', 1)->whereIn('request_dept_category_name', ['Production'])->get()->count();
        $sulut = Leave::where('ap_hrd', 1)->where('r_departure', $data['sulut'])->whereBetween('leave_date', [$request['makeStart'], $request['maekEnd']])->where('leave_category_id', 1)->whereIn('request_dept_category_name', ['Production'])->get()->count();
        $sulteng = Leave::where('ap_hrd', 1)->where('r_departure', $data['sulteng'])->whereBetween('leave_date', [$request['makeStart'], $request['maekEnd']])->where('leave_category_id', 1)->whereIn('request_dept_category_name', ['Production'])->get()->count();
        $sulsel = Leave::where('ap_hrd', 1)->where('r_departure', $data['sulsel'])->whereBetween('leave_date', [$request['makeStart'], $request['maekEnd']])->where('leave_category_id', 1)->whereIn('request_dept_category_name', ['Production'])->get()->count();
        $sultengga = Leave::where('ap_hrd', 1)->where('r_departure', $data['sultengga'])->whereBetween('leave_date', [$request['makeStart'], $request['maekEnd']])->where('leave_category_id', 1)->whereIn('request_dept_category_name', ['Production'])->get()->count();
        $goro = Leave::where('ap_hrd', 1)->where('r_departure', $data['goro'])->whereBetween('leave_date', [$request['makeStart'], $request['maekEnd']])->where('leave_category_id', 1)->whereIn('request_dept_category_name', ['Production'])->get()->count();
        $sulbar = Leave::where('ap_hrd', 1)->where('r_departure', $data['sulbar'])->whereBetween('leave_date', [$request['makeStart'], $request['maekEnd']])->where('leave_category_id', 1)->whereIn('request_dept_category_name', ['Production'])->get()->count();
        $maluku = Leave::where('ap_hrd', 1)->where('r_departure', $data['maluku'])->whereBetween('leave_date', [$request['makeStart'], $request['maekEnd']])->where('leave_category_id', 1)->whereIn('request_dept_category_name', ['Production'])->get()->count();
        $malut = Leave::where('ap_hrd', 1)->where('r_departure', $data['malut'])->whereBetween('leave_date', [$request['makeStart'], $request['maekEnd']])->where('leave_category_id', 1)->whereIn('request_dept_category_name', ['Production'])->get()->count();
        $papuabar = Leave::where('ap_hrd', 1)->where('r_departure', $data['papuabar'])->whereBetween('leave_date', [$request['makeStart'], $request['maekEnd']])->where('leave_category_id', 1)->whereIn('request_dept_category_name', ['Production'])->get()->count();
        $papua = Leave::where('ap_hrd', 1)->where('r_departure', $data['papua'])->whereBetween('leave_date', [$request['makeStart'], $request['maekEnd']])->where('leave_category_id', 1)->whereIn('request_dept_category_name', ['Production'])->get()->count();

        $result = [
            "aceh" => $aceh,
            "sumut" => $sumut,
            "sumbar" => $sumbar,
            "riau" => $riau,
            "jambi" => $jambi,
            "sumsel" => $sumsel,
            "bengkulu" => $bengkulu,
            "lampung" => $lampung,
            "bangka" => $bangka,
            "kepri" => $kepri,
            "dki" => $dki,
            "jabar" => $jabar,
            "jateng" => $jateng,
            "yogya" => $yogya,
            "jatim" => $jatim,
            "banten" => $banten,
            "bali" => $bali,
            "ntb" => $ntb,
            "ntt" => $ntt,
            "kalbar" => $kalbar,
            "kalteng" => $kalteng,
            "kalsel" => $kalsel,
            "kaltim" => $kaltim,
            "kalut" => $kalut,
            "sulut" => $sulut,
            "sulteng" => $sulteng,
            "sulsel" => $sulsel,
            "sultengga" => $sultengga,
            "goro" => $goro,
            "sulbar" => $sulbar,
            "maluku" => $maluku,
            "malut" => $malut,
            "papuabar" => $papuabar,
            "papua" => $papua,
        ];

        return $result;
    }

    private function getObjectDataProvinsiForProductionExdo($request)
    {
        $data = $this->dataProvinsi();

        $aceh = Leave::where('ap_hrd', 1)->where('r_departure', $data['aceh'])->whereBetween('leave_date', [$request['makeStart'], $request['maekEnd']])->where('leave_category_id', 2)->whereIn('request_dept_category_name', ['Production'])->get()->count();
        $sumut = Leave::where('ap_hrd', 1)->where('r_departure', $data['sumut'])->whereBetween('leave_date', [$request['makeStart'], $request['maekEnd']])->where('leave_category_id', 2)->whereIn('request_dept_category_name', ['Production'])->get()->count();
        $sumbar = Leave::where('ap_hrd', 1)->where('r_departure', $data['sumbar'])->whereBetween('leave_date', [$request['makeStart'], $request['maekEnd']])->where('leave_category_id', 2)->whereIn('request_dept_category_name', ['Production'])->get()->count();
        $riau = Leave::where('ap_hrd', 1)->where('r_departure', $data['riau'])->whereBetween('leave_date', [$request['makeStart'], $request['maekEnd']])->where('leave_category_id', 2)->whereIn('request_dept_category_name', ['Production'])->get()->count();
        $jambi = Leave::where('ap_hrd', 1)->where('r_departure', $data['jambi'])->whereBetween('leave_date', [$request['makeStart'], $request['maekEnd']])->where('leave_category_id', 2)->whereIn('request_dept_category_name', ['Production'])->get()->count();
        $sumsel = Leave::where('ap_hrd', 1)->where('r_departure', $data['sumsel'])->whereBetween('leave_date', [$request['makeStart'], $request['maekEnd']])->where('leave_category_id', 2)->whereIn('request_dept_category_name', ['Production'])->get()->count();
        $bengkulu = Leave::where('ap_hrd', 1)->where('r_departure', $data['bengkulu'])->whereBetween('leave_date', [$request['makeStart'], $request['maekEnd']])->where('leave_category_id', 2)->whereIn('request_dept_category_name', ['Production'])->get()->count();
        $lampung = Leave::where('ap_hrd', 1)->where('r_departure', $data['lampung'])->whereBetween('leave_date', [$request['makeStart'], $request['maekEnd']])->where('leave_category_id', 2)->whereIn('request_dept_category_name', ['Production'])->get()->count();
        $bangka = Leave::where('ap_hrd', 1)->where('r_departure', $data['bangka'])->whereBetween('leave_date', [$request['makeStart'], $request['maekEnd']])->where('leave_category_id', 2)->whereIn('request_dept_category_name', ['Production'])->get()->count();
        $kepri = Leave::where('ap_hrd', 1)->where('r_departure', $data['kepri'])->whereBetween('leave_date', [$request['makeStart'], $request['maekEnd']])->where('leave_category_id', 2)->whereIn('request_dept_category_name', ['Production'])->get()->count();
        $dki = Leave::where('ap_hrd', 1)->where('r_departure', $data['dki'])->whereBetween('leave_date', [$request['makeStart'], $request['maekEnd']])->where('leave_category_id', 2)->whereIn('request_dept_category_name', ['Production'])->get()->count();
        $jabar = Leave::where('ap_hrd', 1)->where('r_departure', $data['jabar'])->whereBetween('leave_date', [$request['makeStart'], $request['maekEnd']])->where('leave_category_id', 2)->whereIn('request_dept_category_name', ['Production'])->get()->count();
        $jateng = Leave::where('ap_hrd', 1)->where('r_departure', $data['jateng'])->whereBetween('leave_date', [$request['makeStart'], $request['maekEnd']])->where('leave_category_id', 2)->whereIn('request_dept_category_name', ['Production'])->get()->count();
        $yogya = Leave::where('ap_hrd', 1)->where('r_departure', $data['yogya'])->whereBetween('leave_date', [$request['makeStart'], $request['maekEnd']])->where('leave_category_id', 2)->whereIn('request_dept_category_name', ['Production'])->get()->count();
        $jatim = Leave::where('ap_hrd', 1)->where('r_departure', $data['jatim'])->whereBetween('leave_date', [$request['makeStart'], $request['maekEnd']])->where('leave_category_id', 2)->whereIn('request_dept_category_name', ['Production'])->get()->count();
        $banten = Leave::where('ap_hrd', 1)->where('r_departure', $data['banten'])->whereBetween('leave_date', [$request['makeStart'], $request['maekEnd']])->where('leave_category_id', 2)->whereIn('request_dept_category_name', ['Production'])->get()->count();
        $bali = Leave::where('ap_hrd', 1)->where('r_departure', $data['bali'])->whereBetween('leave_date', [$request['makeStart'], $request['maekEnd']])->where('leave_category_id', 2)->whereIn('request_dept_category_name', ['Production'])->get()->count();
        $ntb = Leave::where('ap_hrd', 1)->where('r_departure', $data['ntb'])->whereBetween('leave_date', [$request['makeStart'], $request['maekEnd']])->where('leave_category_id', 2)->whereIn('request_dept_category_name', ['Production'])->get()->count();
        $ntt = Leave::where('ap_hrd', 1)->where('r_departure', $data['ntt'])->whereBetween('leave_date', [$request['makeStart'], $request['maekEnd']])->where('leave_category_id', 2)->whereIn('request_dept_category_name', ['Production'])->get()->count();
        $kalbar = Leave::where('ap_hrd', 1)->where('r_departure', $data['kalbar'])->whereBetween('leave_date', [$request['makeStart'], $request['maekEnd']])->where('leave_category_id', 2)->whereIn('request_dept_category_name', ['Production'])->get()->count();
        $kalteng = Leave::where('ap_hrd', 1)->where('r_departure', $data['kalteng'])->whereBetween('leave_date', [$request['makeStart'], $request['maekEnd']])->where('leave_category_id', 2)->whereIn('request_dept_category_name', ['Production'])->get()->count();
        $kalsel = Leave::where('ap_hrd', 1)->where('r_departure', $data['kalsel'])->whereBetween('leave_date', [$request['makeStart'], $request['maekEnd']])->where('leave_category_id', 2)->whereIn('request_dept_category_name', ['Production'])->get()->count();
        $kaltim = Leave::where('ap_hrd', 1)->where('r_departure', $data['kaltim'])->whereBetween('leave_date', [$request['makeStart'], $request['maekEnd']])->where('leave_category_id', 2)->whereIn('request_dept_category_name', ['Production'])->get()->count();
        $kalut = Leave::where('ap_hrd', 1)->where('r_departure', $data['kalut'])->whereBetween('leave_date', [$request['makeStart'], $request['maekEnd']])->where('leave_category_id', 2)->whereIn('request_dept_category_name', ['Production'])->get()->count();
        $sulut = Leave::where('ap_hrd', 1)->where('r_departure', $data['sulut'])->whereBetween('leave_date', [$request['makeStart'], $request['maekEnd']])->where('leave_category_id', 2)->whereIn('request_dept_category_name', ['Production'])->get()->count();
        $sulteng = Leave::where('ap_hrd', 1)->where('r_departure', $data['sulteng'])->whereBetween('leave_date', [$request['makeStart'], $request['maekEnd']])->where('leave_category_id', 2)->whereIn('request_dept_category_name', ['Production'])->get()->count();
        $sulsel = Leave::where('ap_hrd', 1)->where('r_departure', $data['sulsel'])->whereBetween('leave_date', [$request['makeStart'], $request['maekEnd']])->where('leave_category_id', 2)->whereIn('request_dept_category_name', ['Production'])->get()->count();
        $sultengga = Leave::where('ap_hrd', 1)->where('r_departure', $data['sultengga'])->whereBetween('leave_date', [$request['makeStart'], $request['maekEnd']])->where('leave_category_id', 2)->whereIn('request_dept_category_name', ['Production'])->get()->count();
        $goro = Leave::where('ap_hrd', 1)->where('r_departure', $data['goro'])->whereBetween('leave_date', [$request['makeStart'], $request['maekEnd']])->where('leave_category_id', 2)->whereIn('request_dept_category_name', ['Production'])->get()->count();
        $sulbar = Leave::where('ap_hrd', 1)->where('r_departure', $data['sulbar'])->whereBetween('leave_date', [$request['makeStart'], $request['maekEnd']])->where('leave_category_id', 2)->whereIn('request_dept_category_name', ['Production'])->get()->count();
        $maluku = Leave::where('ap_hrd', 1)->where('r_departure', $data['maluku'])->whereBetween('leave_date', [$request['makeStart'], $request['maekEnd']])->where('leave_category_id', 2)->whereIn('request_dept_category_name', ['Production'])->get()->count();
        $malut = Leave::where('ap_hrd', 1)->where('r_departure', $data['malut'])->whereBetween('leave_date', [$request['makeStart'], $request['maekEnd']])->where('leave_category_id', 2)->whereIn('request_dept_category_name', ['Production'])->get()->count();
        $papuabar = Leave::where('ap_hrd', 1)->where('r_departure', $data['papuabar'])->whereBetween('leave_date', [$request['makeStart'], $request['maekEnd']])->where('leave_category_id', 2)->whereIn('request_dept_category_name', ['Production'])->get()->count();
        $papua = Leave::where('ap_hrd', 1)->where('r_departure', $data['papua'])->whereBetween('leave_date', [$request['makeStart'], $request['maekEnd']])->where('leave_category_id', 2)->whereIn('request_dept_category_name', ['Production'])->get()->count();

        $result = [
            "aceh" => $aceh,
            "sumut" => $sumut,
            "sumbar" => $sumbar,
            "riau" => $riau,
            "jambi" => $jambi,
            "sumsel" => $sumsel,
            "bengkulu" => $bengkulu,
            "lampung" => $lampung,
            "bangka" => $bangka,
            "kepri" => $kepri,
            "dki" => $dki,
            "jabar" => $jabar,
            "jateng" => $jateng,
            "yogya" => $yogya,
            "jatim" => $jatim,
            "banten" => $banten,
            "bali" => $bali,
            "ntb" => $ntb,
            "ntt" => $ntt,
            "kalbar" => $kalbar,
            "kalteng" => $kalteng,
            "kalsel" => $kalsel,
            "kaltim" => $kaltim,
            "kalut" => $kalut,
            "sulut" => $sulut,
            "sulteng" => $sulteng,
            "sulsel" => $sulsel,
            "sultengga" => $sultengga,
            "goro" => $goro,
            "sulbar" => $sulbar,
            "maluku" => $maluku,
            "malut" => $malut,
            "papuabar" => $papuabar,
            "papua" => $papua,
        ];

        return $result;
    }

    private function getObjectDataProvinsiForProductionEtc($request)
    {
        $data = $this->dataProvinsi();

        $aceh = Leave::where('ap_hrd', 1)->where('r_departure', $data['aceh'])->whereBetween('leave_date', [$request['makeStart'], $request['maekEnd']])->whereNotIn('leave_category_id', [1, 2])->whereIn('request_dept_category_name', ['Production'])->get()->count();
        $sumut = Leave::where('ap_hrd', 1)->where('r_departure', $data['sumut'])->whereBetween('leave_date', [$request['makeStart'], $request['maekEnd']])->whereNotIn('leave_category_id', [1, 2])->whereIn('request_dept_category_name', ['Production'])->get()->count();
        $sumbar = Leave::where('ap_hrd', 1)->where('r_departure', $data['sumbar'])->whereBetween('leave_date', [$request['makeStart'], $request['maekEnd']])->whereNotIn('leave_category_id', [1, 2])->whereIn('request_dept_category_name', ['Production'])->get()->count();
        $riau = Leave::where('ap_hrd', 1)->where('r_departure', $data['riau'])->whereBetween('leave_date', [$request['makeStart'], $request['maekEnd']])->whereNotIn('leave_category_id', [1, 2])->whereIn('request_dept_category_name', ['Production'])->get()->count();
        $jambi = Leave::where('ap_hrd', 1)->where('r_departure', $data['jambi'])->whereBetween('leave_date', [$request['makeStart'], $request['maekEnd']])->whereNotIn('leave_category_id', [1, 2])->whereIn('request_dept_category_name', ['Production'])->get()->count();
        $sumsel = Leave::where('ap_hrd', 1)->where('r_departure', $data['sumsel'])->whereBetween('leave_date', [$request['makeStart'], $request['maekEnd']])->whereNotIn('leave_category_id', [1, 2])->whereIn('request_dept_category_name', ['Production'])->get()->count();
        $bengkulu = Leave::where('ap_hrd', 1)->where('r_departure', $data['bengkulu'])->whereBetween('leave_date', [$request['makeStart'], $request['maekEnd']])->whereNotIn('leave_category_id', [1, 2])->whereIn('request_dept_category_name', ['Production'])->get()->count();
        $lampung = Leave::where('ap_hrd', 1)->where('r_departure', $data['lampung'])->whereBetween('leave_date', [$request['makeStart'], $request['maekEnd']])->whereNotIn('leave_category_id', [1, 2])->whereIn('request_dept_category_name', ['Production'])->get()->count();
        $bangka = Leave::where('ap_hrd', 1)->where('r_departure', $data['bangka'])->whereBetween('leave_date', [$request['makeStart'], $request['maekEnd']])->whereNotIn('leave_category_id', [1, 2])->whereIn('request_dept_category_name', ['Production'])->get()->count();
        $kepri = Leave::where('ap_hrd', 1)->where('r_departure', $data['kepri'])->whereBetween('leave_date', [$request['makeStart'], $request['maekEnd']])->whereNotIn('leave_category_id', [1, 2])->whereIn('request_dept_category_name', ['Production'])->get()->count();
        $dki = Leave::where('ap_hrd', 1)->where('r_departure', $data['dki'])->whereBetween('leave_date', [$request['makeStart'], $request['maekEnd']])->whereNotIn('leave_category_id', [1, 2])->whereIn('request_dept_category_name', ['Production'])->get()->count();
        $jabar = Leave::where('ap_hrd', 1)->where('r_departure', $data['jabar'])->whereBetween('leave_date', [$request['makeStart'], $request['maekEnd']])->whereNotIn('leave_category_id', [1, 2])->whereIn('request_dept_category_name', ['Production'])->get()->count();
        $jateng = Leave::where('ap_hrd', 1)->where('r_departure', $data['jateng'])->whereBetween('leave_date', [$request['makeStart'], $request['maekEnd']])->whereNotIn('leave_category_id', [1, 2])->whereIn('request_dept_category_name', ['Production'])->get()->count();
        $yogya = Leave::where('ap_hrd', 1)->where('r_departure', $data['yogya'])->whereBetween('leave_date', [$request['makeStart'], $request['maekEnd']])->whereNotIn('leave_category_id', [1, 2])->whereIn('request_dept_category_name', ['Production'])->get()->count();
        $jatim = Leave::where('ap_hrd', 1)->where('r_departure', $data['jatim'])->whereBetween('leave_date', [$request['makeStart'], $request['maekEnd']])->whereNotIn('leave_category_id', [1, 2])->whereIn('request_dept_category_name', ['Production'])->get()->count();
        $banten = Leave::where('ap_hrd', 1)->where('r_departure', $data['banten'])->whereBetween('leave_date', [$request['makeStart'], $request['maekEnd']])->whereNotIn('leave_category_id', [1, 2])->whereIn('request_dept_category_name', ['Production'])->get()->count();
        $bali = Leave::where('ap_hrd', 1)->where('r_departure', $data['bali'])->whereBetween('leave_date', [$request['makeStart'], $request['maekEnd']])->whereNotIn('leave_category_id', [1, 2])->whereIn('request_dept_category_name', ['Production'])->get()->count();
        $ntb = Leave::where('ap_hrd', 1)->where('r_departure', $data['ntb'])->whereBetween('leave_date', [$request['makeStart'], $request['maekEnd']])->whereNotIn('leave_category_id', [1, 2])->whereIn('request_dept_category_name', ['Production'])->get()->count();
        $ntt = Leave::where('ap_hrd', 1)->where('r_departure', $data['ntt'])->whereBetween('leave_date', [$request['makeStart'], $request['maekEnd']])->whereNotIn('leave_category_id', [1, 2])->whereIn('request_dept_category_name', ['Production'])->get()->count();
        $kalbar = Leave::where('ap_hrd', 1)->where('r_departure', $data['kalbar'])->whereBetween('leave_date', [$request['makeStart'], $request['maekEnd']])->whereNotIn('leave_category_id', [1, 2])->whereIn('request_dept_category_name', ['Production'])->get()->count();
        $kalteng = Leave::where('ap_hrd', 1)->where('r_departure', $data['kalteng'])->whereBetween('leave_date', [$request['makeStart'], $request['maekEnd']])->whereNotIn('leave_category_id', [1, 2])->whereIn('request_dept_category_name', ['Production'])->get()->count();
        $kalsel = Leave::where('ap_hrd', 1)->where('r_departure', $data['kalsel'])->whereBetween('leave_date', [$request['makeStart'], $request['maekEnd']])->whereNotIn('leave_category_id', [1, 2])->whereIn('request_dept_category_name', ['Production'])->get()->count();
        $kaltim = Leave::where('ap_hrd', 1)->where('r_departure', $data['kaltim'])->whereBetween('leave_date', [$request['makeStart'], $request['maekEnd']])->whereNotIn('leave_category_id', [1, 2])->whereIn('request_dept_category_name', ['Production'])->get()->count();
        $kalut = Leave::where('ap_hrd', 1)->where('r_departure', $data['kalut'])->whereBetween('leave_date', [$request['makeStart'], $request['maekEnd']])->whereNotIn('leave_category_id', [1, 2])->whereIn('request_dept_category_name', ['Production'])->get()->count();
        $sulut = Leave::where('ap_hrd', 1)->where('r_departure', $data['sulut'])->whereBetween('leave_date', [$request['makeStart'], $request['maekEnd']])->whereNotIn('leave_category_id', [1, 2])->whereIn('request_dept_category_name', ['Production'])->get()->count();
        $sulteng = Leave::where('ap_hrd', 1)->where('r_departure', $data['sulteng'])->whereBetween('leave_date', [$request['makeStart'], $request['maekEnd']])->whereNotIn('leave_category_id', [1, 2])->whereIn('request_dept_category_name', ['Production'])->get()->count();
        $sulsel = Leave::where('ap_hrd', 1)->where('r_departure', $data['sulsel'])->whereBetween('leave_date', [$request['makeStart'], $request['maekEnd']])->whereNotIn('leave_category_id', [1, 2])->whereIn('request_dept_category_name', ['Production'])->get()->count();
        $sultengga = Leave::where('ap_hrd', 1)->where('r_departure', $data['sultengga'])->whereBetween('leave_date', [$request['makeStart'], $request['maekEnd']])->whereNotIn('leave_category_id', [1, 2])->whereIn('request_dept_category_name', ['Production'])->get()->count();
        $goro = Leave::where('ap_hrd', 1)->where('r_departure', $data['goro'])->whereBetween('leave_date', [$request['makeStart'], $request['maekEnd']])->whereNotIn('leave_category_id', [1, 2])->whereIn('request_dept_category_name', ['Production'])->get()->count();
        $sulbar = Leave::where('ap_hrd', 1)->where('r_departure', $data['sulbar'])->whereBetween('leave_date', [$request['makeStart'], $request['maekEnd']])->whereNotIn('leave_category_id', [1, 2])->whereIn('request_dept_category_name', ['Production'])->get()->count();
        $maluku = Leave::where('ap_hrd', 1)->where('r_departure', $data['maluku'])->whereBetween('leave_date', [$request['makeStart'], $request['maekEnd']])->whereNotIn('leave_category_id', [1, 2])->whereIn('request_dept_category_name', ['Production'])->get()->count();
        $malut = Leave::where('ap_hrd', 1)->where('r_departure', $data['malut'])->whereBetween('leave_date', [$request['makeStart'], $request['maekEnd']])->whereNotIn('leave_category_id', [1, 2])->whereIn('request_dept_category_name', ['Production'])->get()->count();
        $papuabar = Leave::where('ap_hrd', 1)->where('r_departure', $data['papuabar'])->whereBetween('leave_date', [$request['makeStart'], $request['maekEnd']])->whereNotIn('leave_category_id', [1, 2])->get()->count();
        $papua = Leave::where('ap_hrd', 1)->where('r_departure', $data['papua'])->whereBetween('leave_date', [$request['makeStart'], $request['maekEnd']])->whereNotIn('leave_category_id', [1, 2])->whereIn('request_dept_category_name', ['Production'])->get()->count();

        $result = [
            "aceh" => $aceh,
            "sumut" => $sumut,
            "sumbar" => $sumbar,
            "riau" => $riau,
            "jambi" => $jambi,
            "sumsel" => $sumsel,
            "bengkulu" => $bengkulu,
            "lampung" => $lampung,
            "bangka" => $bangka,
            "kepri" => $kepri,
            "dki" => $dki,
            "jabar" => $jabar,
            "jateng" => $jateng,
            "yogya" => $yogya,
            "jatim" => $jatim,
            "banten" => $banten,
            "bali" => $bali,
            "ntb" => $ntb,
            "ntt" => $ntt,
            "kalbar" => $kalbar,
            "kalteng" => $kalteng,
            "kalsel" => $kalsel,
            "kaltim" => $kaltim,
            "kalut" => $kalut,
            "sulut" => $sulut,
            "sulteng" => $sulteng,
            "sulsel" => $sulsel,
            "sultengga" => $sultengga,
            "goro" => $goro,
            "sulbar" => $sulbar,
            "maluku" => $maluku,
            "malut" => $malut,
            "papuabar" => $papuabar,
            "papua" => $papua,
        ];

        return $result;
    }

    private function getObjectDataProvinsiForOfficerAnnual($request)
    {
        $data = $this->dataProvinsi();

        $aceh = Leave::where('ap_hrd', 1)->where('r_departure', $data['aceh'])->whereBetween('leave_date', [$request['makeStart'], $request['maekEnd']])->where('leave_category_id', 1)->whereNotIn('request_dept_category_name', ['Production'])->get()->count();
        $sumut = Leave::where('ap_hrd', 1)->where('r_departure', $data['sumut'])->whereBetween('leave_date', [$request['makeStart'], $request['maekEnd']])->where('leave_category_id', 1)->whereNotIn('request_dept_category_name', ['Production'])->get()->count();
        $sumbar = Leave::where('ap_hrd', 1)->where('r_departure', $data['sumbar'])->whereBetween('leave_date', [$request['makeStart'], $request['maekEnd']])->where('leave_category_id', 1)->whereNotIn('request_dept_category_name', ['Production'])->get()->count();
        $riau = Leave::where('ap_hrd', 1)->where('r_departure', $data['riau'])->whereBetween('leave_date', [$request['makeStart'], $request['maekEnd']])->where('leave_category_id', 1)->whereNotIn('request_dept_category_name', ['Production'])->get()->count();
        $jambi = Leave::where('ap_hrd', 1)->where('r_departure', $data['jambi'])->whereBetween('leave_date', [$request['makeStart'], $request['maekEnd']])->where('leave_category_id', 1)->whereNotIn('request_dept_category_name', ['Production'])->get()->count();
        $sumsel = Leave::where('ap_hrd', 1)->where('r_departure', $data['sumsel'])->whereBetween('leave_date', [$request['makeStart'], $request['maekEnd']])->where('leave_category_id', 1)->whereNotIn('request_dept_category_name', ['Production'])->get()->count();
        $bengkulu = Leave::where('ap_hrd', 1)->where('r_departure', $data['bengkulu'])->whereBetween('leave_date', [$request['makeStart'], $request['maekEnd']])->where('leave_category_id', 1)->whereNotIn('request_dept_category_name', ['Production'])->get()->count();
        $lampung = Leave::where('ap_hrd', 1)->where('r_departure', $data['lampung'])->whereBetween('leave_date', [$request['makeStart'], $request['maekEnd']])->where('leave_category_id', 1)->whereNotIn('request_dept_category_name', ['Production'])->get()->count();
        $bangka = Leave::where('ap_hrd', 1)->where('r_departure', $data['bangka'])->whereBetween('leave_date', [$request['makeStart'], $request['maekEnd']])->where('leave_category_id', 1)->whereNotIn('request_dept_category_name', ['Production'])->get()->count();
        $kepri = Leave::where('ap_hrd', 1)->where('r_departure', $data['kepri'])->whereBetween('leave_date', [$request['makeStart'], $request['maekEnd']])->where('leave_category_id', 1)->whereNotIn('request_dept_category_name', ['Production'])->get()->count();
        $dki = Leave::where('ap_hrd', 1)->where('r_departure', $data['dki'])->whereBetween('leave_date', [$request['makeStart'], $request['maekEnd']])->where('leave_category_id', 1)->whereNotIn('request_dept_category_name', ['Production'])->get()->count();
        $jabar = Leave::where('ap_hrd', 1)->where('r_departure', $data['jabar'])->whereBetween('leave_date', [$request['makeStart'], $request['maekEnd']])->where('leave_category_id', 1)->whereNotIn('request_dept_category_name', ['Production'])->get()->count();
        $jateng = Leave::where('ap_hrd', 1)->where('r_departure', $data['jateng'])->whereBetween('leave_date', [$request['makeStart'], $request['maekEnd']])->where('leave_category_id', 1)->whereNotIn('request_dept_category_name', ['Production'])->get()->count();
        $yogya = Leave::where('ap_hrd', 1)->where('r_departure', $data['yogya'])->whereBetween('leave_date', [$request['makeStart'], $request['maekEnd']])->where('leave_category_id', 1)->whereNotIn('request_dept_category_name', ['Production'])->get()->count();
        $jatim = Leave::where('ap_hrd', 1)->where('r_departure', $data['jatim'])->whereBetween('leave_date', [$request['makeStart'], $request['maekEnd']])->where('leave_category_id', 1)->whereNotIn('request_dept_category_name', ['Production'])->get()->count();
        $banten = Leave::where('ap_hrd', 1)->where('r_departure', $data['banten'])->whereBetween('leave_date', [$request['makeStart'], $request['maekEnd']])->where('leave_category_id', 1)->whereNotIn('request_dept_category_name', ['Production'])->get()->count();
        $bali = Leave::where('ap_hrd', 1)->where('r_departure', $data['bali'])->whereBetween('leave_date', [$request['makeStart'], $request['maekEnd']])->where('leave_category_id', 1)->whereNotIn('request_dept_category_name', ['Production'])->get()->count();
        $ntb = Leave::where('ap_hrd', 1)->where('r_departure', $data['ntb'])->whereBetween('leave_date', [$request['makeStart'], $request['maekEnd']])->where('leave_category_id', 1)->whereNotIn('request_dept_category_name', ['Production'])->get()->count();
        $ntt = Leave::where('ap_hrd', 1)->where('r_departure', $data['ntt'])->whereBetween('leave_date', [$request['makeStart'], $request['maekEnd']])->where('leave_category_id', 1)->whereNotIn('request_dept_category_name', ['Production'])->get()->count();
        $kalbar = Leave::where('ap_hrd', 1)->where('r_departure', $data['kalbar'])->whereBetween('leave_date', [$request['makeStart'], $request['maekEnd']])->where('leave_category_id', 1)->whereNotIn('request_dept_category_name', ['Production'])->get()->count();
        $kalteng = Leave::where('ap_hrd', 1)->where('r_departure', $data['kalteng'])->whereBetween('leave_date', [$request['makeStart'], $request['maekEnd']])->where('leave_category_id', 1)->whereNotIn('request_dept_category_name', ['Production'])->get()->count();
        $kalsel = Leave::where('ap_hrd', 1)->where('r_departure', $data['kalsel'])->whereBetween('leave_date', [$request['makeStart'], $request['maekEnd']])->where('leave_category_id', 1)->whereNotIn('request_dept_category_name', ['Production'])->get()->count();
        $kaltim = Leave::where('ap_hrd', 1)->where('r_departure', $data['kaltim'])->whereBetween('leave_date', [$request['makeStart'], $request['maekEnd']])->where('leave_category_id', 1)->whereNotIn('request_dept_category_name', ['Production'])->get()->count();
        $kalut = Leave::where('ap_hrd', 1)->where('r_departure', $data['kalut'])->whereBetween('leave_date', [$request['makeStart'], $request['maekEnd']])->where('leave_category_id', 1)->whereNotIn('request_dept_category_name', ['Production'])->get()->count();
        $sulut = Leave::where('ap_hrd', 1)->where('r_departure', $data['sulut'])->whereBetween('leave_date', [$request['makeStart'], $request['maekEnd']])->where('leave_category_id', 1)->whereNotIn('request_dept_category_name', ['Production'])->get()->count();
        $sulteng = Leave::where('ap_hrd', 1)->where('r_departure', $data['sulteng'])->whereBetween('leave_date', [$request['makeStart'], $request['maekEnd']])->where('leave_category_id', 1)->whereNotIn('request_dept_category_name', ['Production'])->get()->count();
        $sulsel = Leave::where('ap_hrd', 1)->where('r_departure', $data['sulsel'])->whereBetween('leave_date', [$request['makeStart'], $request['maekEnd']])->where('leave_category_id', 1)->whereNotIn('request_dept_category_name', ['Production'])->get()->count();
        $sultengga = Leave::where('ap_hrd', 1)->where('r_departure', $data['sultengga'])->whereBetween('leave_date', [$request['makeStart'], $request['maekEnd']])->where('leave_category_id', 1)->whereNotIn('request_dept_category_name', ['Production'])->get()->count();
        $goro = Leave::where('ap_hrd', 1)->where('r_departure', $data['goro'])->whereBetween('leave_date', [$request['makeStart'], $request['maekEnd']])->where('leave_category_id', 1)->whereNotIn('request_dept_category_name', ['Production'])->get()->count();
        $sulbar = Leave::where('ap_hrd', 1)->where('r_departure', $data['sulbar'])->whereBetween('leave_date', [$request['makeStart'], $request['maekEnd']])->where('leave_category_id', 1)->whereNotIn('request_dept_category_name', ['Production'])->get()->count();
        $maluku = Leave::where('ap_hrd', 1)->where('r_departure', $data['maluku'])->whereBetween('leave_date', [$request['makeStart'], $request['maekEnd']])->where('leave_category_id', 1)->whereNotIn('request_dept_category_name', ['Production'])->get()->count();
        $malut = Leave::where('ap_hrd', 1)->where('r_departure', $data['malut'])->whereBetween('leave_date', [$request['makeStart'], $request['maekEnd']])->where('leave_category_id', 1)->whereNotIn('request_dept_category_name', ['Production'])->get()->count();
        $papuabar = Leave::where('ap_hrd', 1)->where('r_departure', $data['papuabar'])->whereBetween('leave_date', [$request['makeStart'], $request['maekEnd']])->where('leave_category_id', 1)->whereNotIn('request_dept_category_name', ['Production'])->get()->count();
        $papua = Leave::where('ap_hrd', 1)->where('r_departure', $data['papua'])->whereBetween('leave_date', [$request['makeStart'], $request['maekEnd']])->where('leave_category_id', 1)->whereNotIn('request_dept_category_name', ['Production'])->get()->count();

        $result = [
            "aceh" => $aceh,
            "sumut" => $sumut,
            "sumbar" => $sumbar,
            "riau" => $riau,
            "jambi" => $jambi,
            "sumsel" => $sumsel,
            "bengkulu" => $bengkulu,
            "lampung" => $lampung,
            "bangka" => $bangka,
            "kepri" => $kepri,
            "dki" => $dki,
            "jabar" => $jabar,
            "jateng" => $jateng,
            "yogya" => $yogya,
            "jatim" => $jatim,
            "banten" => $banten,
            "bali" => $bali,
            "ntb" => $ntb,
            "ntt" => $ntt,
            "kalbar" => $kalbar,
            "kalteng" => $kalteng,
            "kalsel" => $kalsel,
            "kaltim" => $kaltim,
            "kalut" => $kalut,
            "sulut" => $sulut,
            "sulteng" => $sulteng,
            "sulsel" => $sulsel,
            "sultengga" => $sultengga,
            "goro" => $goro,
            "sulbar" => $sulbar,
            "maluku" => $maluku,
            "malut" => $malut,
            "papuabar" => $papuabar,
            "papua" => $papua,
        ];

        return $result;
    }

    private function getObjectDataProvinsiForOfficerExdo($request)
    {
        $data = $this->dataProvinsi();

        $aceh = Leave::where('ap_hrd', 1)->where('r_departure', $data['aceh'])->whereBetween('leave_date', [$request['makeStart'], $request['maekEnd']])->where('leave_category_id', 2)->whereNotIn('request_dept_category_name', ['Production'])->get()->count();
        $sumut = Leave::where('ap_hrd', 1)->where('r_departure', $data['sumut'])->whereBetween('leave_date', [$request['makeStart'], $request['maekEnd']])->where('leave_category_id', 2)->whereNotIn('request_dept_category_name', ['Production'])->get()->count();
        $sumbar = Leave::where('ap_hrd', 1)->where('r_departure', $data['sumbar'])->whereBetween('leave_date', [$request['makeStart'], $request['maekEnd']])->where('leave_category_id', 2)->whereNotIn('request_dept_category_name', ['Production'])->get()->count();
        $riau = Leave::where('ap_hrd', 1)->where('r_departure', $data['riau'])->whereBetween('leave_date', [$request['makeStart'], $request['maekEnd']])->where('leave_category_id', 2)->whereNotIn('request_dept_category_name', ['Production'])->get()->count();
        $jambi = Leave::where('ap_hrd', 1)->where('r_departure', $data['jambi'])->whereBetween('leave_date', [$request['makeStart'], $request['maekEnd']])->where('leave_category_id', 2)->whereNotIn('request_dept_category_name', ['Production'])->get()->count();
        $sumsel = Leave::where('ap_hrd', 1)->where('r_departure', $data['sumsel'])->whereBetween('leave_date', [$request['makeStart'], $request['maekEnd']])->where('leave_category_id', 2)->whereNotIn('request_dept_category_name', ['Production'])->get()->count();
        $bengkulu = Leave::where('ap_hrd', 1)->where('r_departure', $data['bengkulu'])->whereBetween('leave_date', [$request['makeStart'], $request['maekEnd']])->where('leave_category_id', 2)->whereNotIn('request_dept_category_name', ['Production'])->get()->count();
        $lampung = Leave::where('ap_hrd', 1)->where('r_departure', $data['lampung'])->whereBetween('leave_date', [$request['makeStart'], $request['maekEnd']])->where('leave_category_id', 2)->whereNotIn('request_dept_category_name', ['Production'])->get()->count();
        $bangka = Leave::where('ap_hrd', 1)->where('r_departure', $data['bangka'])->whereBetween('leave_date', [$request['makeStart'], $request['maekEnd']])->where('leave_category_id', 2)->whereNotIn('request_dept_category_name', ['Production'])->get()->count();
        $kepri = Leave::where('ap_hrd', 1)->where('r_departure', $data['kepri'])->whereBetween('leave_date', [$request['makeStart'], $request['maekEnd']])->where('leave_category_id', 2)->whereNotIn('request_dept_category_name', ['Production'])->get()->count();
        $dki = Leave::where('ap_hrd', 1)->where('r_departure', $data['dki'])->whereBetween('leave_date', [$request['makeStart'], $request['maekEnd']])->where('leave_category_id', 2)->whereNotIn('request_dept_category_name', ['Production'])->get()->count();
        $jabar = Leave::where('ap_hrd', 1)->where('r_departure', $data['jabar'])->whereBetween('leave_date', [$request['makeStart'], $request['maekEnd']])->where('leave_category_id', 2)->whereNotIn('request_dept_category_name', ['Production'])->get()->count();
        $jateng = Leave::where('ap_hrd', 1)->where('r_departure', $data['jateng'])->whereBetween('leave_date', [$request['makeStart'], $request['maekEnd']])->where('leave_category_id', 2)->whereNotIn('request_dept_category_name', ['Production'])->get()->count();
        $yogya = Leave::where('ap_hrd', 1)->where('r_departure', $data['yogya'])->whereBetween('leave_date', [$request['makeStart'], $request['maekEnd']])->where('leave_category_id', 2)->whereNotIn('request_dept_category_name', ['Production'])->get()->count();
        $jatim = Leave::where('ap_hrd', 1)->where('r_departure', $data['jatim'])->whereBetween('leave_date', [$request['makeStart'], $request['maekEnd']])->where('leave_category_id', 2)->whereNotIn('request_dept_category_name', ['Production'])->get()->count();
        $banten = Leave::where('ap_hrd', 1)->where('r_departure', $data['banten'])->whereBetween('leave_date', [$request['makeStart'], $request['maekEnd']])->where('leave_category_id', 2)->whereNotIn('request_dept_category_name', ['Production'])->get()->count();
        $bali = Leave::where('ap_hrd', 1)->where('r_departure', $data['bali'])->whereBetween('leave_date', [$request['makeStart'], $request['maekEnd']])->where('leave_category_id', 2)->whereNotIn('request_dept_category_name', ['Production'])->get()->count();
        $ntb = Leave::where('ap_hrd', 1)->where('r_departure', $data['ntb'])->whereBetween('leave_date', [$request['makeStart'], $request['maekEnd']])->where('leave_category_id', 2)->whereNotIn('request_dept_category_name', ['Production'])->get()->count();
        $ntt = Leave::where('ap_hrd', 1)->where('r_departure', $data['ntt'])->whereBetween('leave_date', [$request['makeStart'], $request['maekEnd']])->where('leave_category_id', 2)->whereNotIn('request_dept_category_name', ['Production'])->get()->count();
        $kalbar = Leave::where('ap_hrd', 1)->where('r_departure', $data['kalbar'])->whereBetween('leave_date', [$request['makeStart'], $request['maekEnd']])->where('leave_category_id', 2)->whereNotIn('request_dept_category_name', ['Production'])->get()->count();
        $kalteng = Leave::where('ap_hrd', 1)->where('r_departure', $data['kalteng'])->whereBetween('leave_date', [$request['makeStart'], $request['maekEnd']])->where('leave_category_id', 2)->whereNotIn('request_dept_category_name', ['Production'])->get()->count();
        $kalsel = Leave::where('ap_hrd', 1)->where('r_departure', $data['kalsel'])->whereBetween('leave_date', [$request['makeStart'], $request['maekEnd']])->where('leave_category_id', 2)->whereNotIn('request_dept_category_name', ['Production'])->get()->count();
        $kaltim = Leave::where('ap_hrd', 1)->where('r_departure', $data['kaltim'])->whereBetween('leave_date', [$request['makeStart'], $request['maekEnd']])->where('leave_category_id', 2)->whereNotIn('request_dept_category_name', ['Production'])->get()->count();
        $kalut = Leave::where('ap_hrd', 1)->where('r_departure', $data['kalut'])->whereBetween('leave_date', [$request['makeStart'], $request['maekEnd']])->where('leave_category_id', 2)->whereNotIn('request_dept_category_name', ['Production'])->get()->count();
        $sulut = Leave::where('ap_hrd', 1)->where('r_departure', $data['sulut'])->whereBetween('leave_date', [$request['makeStart'], $request['maekEnd']])->where('leave_category_id', 2)->whereNotIn('request_dept_category_name', ['Production'])->get()->count();
        $sulteng = Leave::where('ap_hrd', 1)->where('r_departure', $data['sulteng'])->whereBetween('leave_date', [$request['makeStart'], $request['maekEnd']])->where('leave_category_id', 2)->whereNotIn('request_dept_category_name', ['Production'])->get()->count();
        $sulsel = Leave::where('ap_hrd', 1)->where('r_departure', $data['sulsel'])->whereBetween('leave_date', [$request['makeStart'], $request['maekEnd']])->where('leave_category_id', 2)->whereNotIn('request_dept_category_name', ['Production'])->get()->count();
        $sultengga = Leave::where('ap_hrd', 1)->where('r_departure', $data['sultengga'])->whereBetween('leave_date', [$request['makeStart'], $request['maekEnd']])->where('leave_category_id', 2)->whereNotIn('request_dept_category_name', ['Production'])->get()->count();
        $goro = Leave::where('ap_hrd', 1)->where('r_departure', $data['goro'])->whereBetween('leave_date', [$request['makeStart'], $request['maekEnd']])->where('leave_category_id', 2)->whereNotIn('request_dept_category_name', ['Production'])->get()->count();
        $sulbar = Leave::where('ap_hrd', 1)->where('r_departure', $data['sulbar'])->whereBetween('leave_date', [$request['makeStart'], $request['maekEnd']])->where('leave_category_id', 2)->whereNotIn('request_dept_category_name', ['Production'])->get()->count();
        $maluku = Leave::where('ap_hrd', 1)->where('r_departure', $data['maluku'])->whereBetween('leave_date', [$request['makeStart'], $request['maekEnd']])->where('leave_category_id', 2)->whereNotIn('request_dept_category_name', ['Production'])->get()->count();
        $malut = Leave::where('ap_hrd', 1)->where('r_departure', $data['malut'])->whereBetween('leave_date', [$request['makeStart'], $request['maekEnd']])->where('leave_category_id', 2)->whereNotIn('request_dept_category_name', ['Production'])->get()->count();
        $papuabar = Leave::where('ap_hrd', 1)->where('r_departure', $data['papuabar'])->whereBetween('leave_date', [$request['makeStart'], $request['maekEnd']])->where('leave_category_id', 2)->whereNotIn('request_dept_category_name', ['Production'])->get()->count();
        $papua = Leave::where('ap_hrd', 1)->where('r_departure', $data['papua'])->whereBetween('leave_date', [$request['makeStart'], $request['maekEnd']])->where('leave_category_id', 2)->whereNotIn('request_dept_category_name', ['Production'])->get()->count();

        $result = [
            "aceh" => $aceh,
            "sumut" => $sumut,
            "sumbar" => $sumbar,
            "riau" => $riau,
            "jambi" => $jambi,
            "sumsel" => $sumsel,
            "bengkulu" => $bengkulu,
            "lampung" => $lampung,
            "bangka" => $bangka,
            "kepri" => $kepri,
            "dki" => $dki,
            "jabar" => $jabar,
            "jateng" => $jateng,
            "yogya" => $yogya,
            "jatim" => $jatim,
            "banten" => $banten,
            "bali" => $bali,
            "ntb" => $ntb,
            "ntt" => $ntt,
            "kalbar" => $kalbar,
            "kalteng" => $kalteng,
            "kalsel" => $kalsel,
            "kaltim" => $kaltim,
            "kalut" => $kalut,
            "sulut" => $sulut,
            "sulteng" => $sulteng,
            "sulsel" => $sulsel,
            "sultengga" => $sultengga,
            "goro" => $goro,
            "sulbar" => $sulbar,
            "maluku" => $maluku,
            "malut" => $malut,
            "papuabar" => $papuabar,
            "papua" => $papua,
        ];

        return $result;
    }

    private function getObjectDataProvinsiForOfficerEtc($request)
    {
        $data = $this->dataProvinsi();

        $aceh = Leave::where('ap_hrd', 1)->where('r_departure', $data['aceh'])->whereBetween('leave_date', [$request['makeStart'], $request['maekEnd']])->whereNotIn('leave_category_id', [1, 2])->whereNotIn('request_dept_category_name', ['Production'])->get()->count();
        $sumut = Leave::where('ap_hrd', 1)->where('r_departure', $data['sumut'])->whereBetween('leave_date', [$request['makeStart'], $request['maekEnd']])->whereNotIn('leave_category_id', [1, 2])->whereNotIn('request_dept_category_name', ['Production'])->get()->count();
        $sumbar = Leave::where('ap_hrd', 1)->where('r_departure', $data['sumbar'])->whereBetween('leave_date', [$request['makeStart'], $request['maekEnd']])->whereNotIn('leave_category_id', [1, 2])->whereNotIn('request_dept_category_name', ['Production'])->get()->count();
        $riau = Leave::where('ap_hrd', 1)->where('r_departure', $data['riau'])->whereBetween('leave_date', [$request['makeStart'], $request['maekEnd']])->whereNotIn('leave_category_id', [1, 2])->whereNotIn('request_dept_category_name', ['Production'])->get()->count();
        $jambi = Leave::where('ap_hrd', 1)->where('r_departure', $data['jambi'])->whereBetween('leave_date', [$request['makeStart'], $request['maekEnd']])->whereNotIn('leave_category_id', [1, 2])->whereNotIn('request_dept_category_name', ['Production'])->get()->count();
        $sumsel = Leave::where('ap_hrd', 1)->where('r_departure', $data['sumsel'])->whereBetween('leave_date', [$request['makeStart'], $request['maekEnd']])->whereNotIn('leave_category_id', [1, 2])->whereNotIn('request_dept_category_name', ['Production'])->get()->count();
        $bengkulu = Leave::where('ap_hrd', 1)->where('r_departure', $data['bengkulu'])->whereBetween('leave_date', [$request['makeStart'], $request['maekEnd']])->whereNotIn('leave_category_id', [1, 2])->whereNotIn('request_dept_category_name', ['Production'])->get()->count();
        $lampung = Leave::where('ap_hrd', 1)->where('r_departure', $data['lampung'])->whereBetween('leave_date', [$request['makeStart'], $request['maekEnd']])->whereNotIn('leave_category_id', [1, 2])->whereNotIn('request_dept_category_name', ['Production'])->get()->count();
        $bangka = Leave::where('ap_hrd', 1)->where('r_departure', $data['bangka'])->whereBetween('leave_date', [$request['makeStart'], $request['maekEnd']])->whereNotIn('leave_category_id', [1, 2])->whereNotIn('request_dept_category_name', ['Production'])->get()->count();
        $kepri = Leave::where('ap_hrd', 1)->where('r_departure', $data['kepri'])->whereBetween('leave_date', [$request['makeStart'], $request['maekEnd']])->whereNotIn('leave_category_id', [1, 2])->whereNotIn('request_dept_category_name', ['Production'])->get()->count();
        $dki = Leave::where('ap_hrd', 1)->where('r_departure', $data['dki'])->whereBetween('leave_date', [$request['makeStart'], $request['maekEnd']])->whereNotIn('leave_category_id', [1, 2])->whereNotIn('request_dept_category_name', ['Production'])->get()->count();
        $jabar = Leave::where('ap_hrd', 1)->where('r_departure', $data['jabar'])->whereBetween('leave_date', [$request['makeStart'], $request['maekEnd']])->whereNotIn('leave_category_id', [1, 2])->whereNotIn('request_dept_category_name', ['Production'])->get()->count();
        $jateng = Leave::where('ap_hrd', 1)->where('r_departure', $data['jateng'])->whereBetween('leave_date', [$request['makeStart'], $request['maekEnd']])->whereNotIn('leave_category_id', [1, 2])->whereNotIn('request_dept_category_name', ['Production'])->get()->count();
        $yogya = Leave::where('ap_hrd', 1)->where('r_departure', $data['yogya'])->whereBetween('leave_date', [$request['makeStart'], $request['maekEnd']])->whereNotIn('leave_category_id', [1, 2])->whereNotIn('request_dept_category_name', ['Production'])->get()->count();
        $jatim = Leave::where('ap_hrd', 1)->where('r_departure', $data['jatim'])->whereBetween('leave_date', [$request['makeStart'], $request['maekEnd']])->whereNotIn('leave_category_id', [1, 2])->whereNotIn('request_dept_category_name', ['Production'])->get()->count();
        $banten = Leave::where('ap_hrd', 1)->where('r_departure', $data['banten'])->whereBetween('leave_date', [$request['makeStart'], $request['maekEnd']])->whereNotIn('leave_category_id', [1, 2])->whereNotIn('request_dept_category_name', ['Production'])->get()->count();
        $bali = Leave::where('ap_hrd', 1)->where('r_departure', $data['bali'])->whereBetween('leave_date', [$request['makeStart'], $request['maekEnd']])->whereNotIn('leave_category_id', [1, 2])->whereNotIn('request_dept_category_name', ['Production'])->get()->count();
        $ntb = Leave::where('ap_hrd', 1)->where('r_departure', $data['ntb'])->whereBetween('leave_date', [$request['makeStart'], $request['maekEnd']])->whereNotIn('leave_category_id', [1, 2])->whereNotIn('request_dept_category_name', ['Production'])->get()->count();
        $ntt = Leave::where('ap_hrd', 1)->where('r_departure', $data['ntt'])->whereBetween('leave_date', [$request['makeStart'], $request['maekEnd']])->whereNotIn('leave_category_id', [1, 2])->whereNotIn('request_dept_category_name', ['Production'])->get()->count();
        $kalbar = Leave::where('ap_hrd', 1)->where('r_departure', $data['kalbar'])->whereBetween('leave_date', [$request['makeStart'], $request['maekEnd']])->whereNotIn('leave_category_id', [1, 2])->whereNotIn('request_dept_category_name', ['Production'])->get()->count();
        $kalteng = Leave::where('ap_hrd', 1)->where('r_departure', $data['kalteng'])->whereBetween('leave_date', [$request['makeStart'], $request['maekEnd']])->whereNotIn('leave_category_id', [1, 2])->whereNotIn('request_dept_category_name', ['Production'])->get()->count();
        $kalsel = Leave::where('ap_hrd', 1)->where('r_departure', $data['kalsel'])->whereBetween('leave_date', [$request['makeStart'], $request['maekEnd']])->whereNotIn('leave_category_id', [1, 2])->whereNotIn('request_dept_category_name', ['Production'])->get()->count();
        $kaltim = Leave::where('ap_hrd', 1)->where('r_departure', $data['kaltim'])->whereBetween('leave_date', [$request['makeStart'], $request['maekEnd']])->whereNotIn('leave_category_id', [1, 2])->whereNotIn('request_dept_category_name', ['Production'])->get()->count();
        $kalut = Leave::where('ap_hrd', 1)->where('r_departure', $data['kalut'])->whereBetween('leave_date', [$request['makeStart'], $request['maekEnd']])->whereNotIn('leave_category_id', [1, 2])->whereNotIn('request_dept_category_name', ['Production'])->get()->count();
        $sulut = Leave::where('ap_hrd', 1)->where('r_departure', $data['sulut'])->whereBetween('leave_date', [$request['makeStart'], $request['maekEnd']])->whereNotIn('leave_category_id', [1, 2])->whereNotIn('request_dept_category_name', ['Production'])->get()->count();
        $sulteng = Leave::where('ap_hrd', 1)->where('r_departure', $data['sulteng'])->whereBetween('leave_date', [$request['makeStart'], $request['maekEnd']])->whereNotIn('leave_category_id', [1, 2])->whereNotIn('request_dept_category_name', ['Production'])->get()->count();
        $sulsel = Leave::where('ap_hrd', 1)->where('r_departure', $data['sulsel'])->whereBetween('leave_date', [$request['makeStart'], $request['maekEnd']])->whereNotIn('leave_category_id', [1, 2])->whereNotIn('request_dept_category_name', ['Production'])->get()->count();
        $sultengga = Leave::where('ap_hrd', 1)->where('r_departure', $data['sultengga'])->whereBetween('leave_date', [$request['makeStart'], $request['maekEnd']])->whereNotIn('leave_category_id', [1, 2])->whereNotIn('request_dept_category_name', ['Production'])->get()->count();
        $goro = Leave::where('ap_hrd', 1)->where('r_departure', $data['goro'])->whereBetween('leave_date', [$request['makeStart'], $request['maekEnd']])->whereNotIn('leave_category_id', [1, 2])->whereNotIn('request_dept_category_name', ['Production'])->get()->count();
        $sulbar = Leave::where('ap_hrd', 1)->where('r_departure', $data['sulbar'])->whereBetween('leave_date', [$request['makeStart'], $request['maekEnd']])->whereNotIn('leave_category_id', [1, 2])->whereNotIn('request_dept_category_name', ['Production'])->get()->count();
        $maluku = Leave::where('ap_hrd', 1)->where('r_departure', $data['maluku'])->whereBetween('leave_date', [$request['makeStart'], $request['maekEnd']])->whereNotIn('leave_category_id', [1, 2])->whereNotIn('request_dept_category_name', ['Production'])->get()->count();
        $malut = Leave::where('ap_hrd', 1)->where('r_departure', $data['malut'])->whereBetween('leave_date', [$request['makeStart'], $request['maekEnd']])->whereNotIn('leave_category_id', [1, 2])->whereNotIn('request_dept_category_name', ['Production'])->get()->count();
        $papuabar = Leave::where('ap_hrd', 1)->where('r_departure', $data['papuabar'])->whereBetween('leave_date', [$request['makeStart'], $request['maekEnd']])->whereNotIn('leave_category_id', [1, 2])->whereNotIn('request_dept_category_name', ['Production'])->get()->count();
        $papua = Leave::where('ap_hrd', 1)->where('r_departure', $data['papua'])->whereBetween('leave_date', [$request['makeStart'], $request['maekEnd']])->whereNotIn('leave_category_id', [1, 2])->whereNotIn('request_dept_category_name', ['Production'])->get()->count();

        $result = [
            "aceh" => $aceh,
            "sumut" => $sumut,
            "sumbar" => $sumbar,
            "riau" => $riau,
            "jambi" => $jambi,
            "sumsel" => $sumsel,
            "bengkulu" => $bengkulu,
            "lampung" => $lampung,
            "bangka" => $bangka,
            "kepri" => $kepri,
            "dki" => $dki,
            "jabar" => $jabar,
            "jateng" => $jateng,
            "yogya" => $yogya,
            "jatim" => $jatim,
            "banten" => $banten,
            "bali" => $bali,
            "ntb" => $ntb,
            "ntt" => $ntt,
            "kalbar" => $kalbar,
            "kalteng" => $kalteng,
            "kalsel" => $kalsel,
            "kaltim" => $kaltim,
            "kalut" => $kalut,
            "sulut" => $sulut,
            "sulteng" => $sulteng,
            "sulsel" => $sulsel,
            "sultengga" => $sultengga,
            "goro" => $goro,
            "sulbar" => $sulbar,
            "maluku" => $maluku,
            "malut" => $malut,
            "papuabar" => $papuabar,
            "papua" => $papua,
        ];

        return $result;
    }

    public function excel(Request $request)
    {
        if ($request->input('leave') == "6") {
            $data = Leave::where('ap_hrd', 1)->whereBetween('leave_date', [$request->input('started'), $request->input('ended')])->whereIn('leave_category_id', [1, 2])->whereIn('request_dept_category_name', ['Production'])->orderBy('leave_date', 'asc')->get();
        } else {
            $data = Leave::where('ap_hrd', 1)->whereBetween('leave_date', [$request->input('started'), $request->input('ended')])->whereIn('leave_category_id', [1, 2])->whereNotIn('request_dept_category_name', ['Production'])->orderBy('leave_date', 'asc')->get();
        }

        $no = 1;

        Excel::create('Summary of The Leave', function ($excel) use ($data, $no) {

            // Set the title
            $excel->setTitle('Summary of The Leave');

            // Chain the setters
            $excel->setCreator('WIS')
                ->setCompany('Kinema');

            // Call them separately
            $excel->setDescription('A demonstration to change the file properties');

            $excel->sheet('Summary of The Leave', function ($sheet) use ($data, $no) {
                $sheet->setAutoSIze(true);
                $sheet->loadView('HRDLevelAcces/leave/summary/chart/excel', compact(['data', 'no']));
            });
        })->download('xls');

        return redirect()->route('hr/summary/leave/chart/index');
    }
}