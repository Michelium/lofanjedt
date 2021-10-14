<?php

namespace App\Controller;

use App\Entity\Entry;
use PhpOffice\PhpSpreadsheet\Exception;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Style\Fill;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Symfony\Component\Routing\Annotation\Route;

class ExportController extends AbstractController {

    /**
     * @Route("/lofanje/export", name="lofanje_export")
     * @throws Exception
     */
    public function export(Request $request) {
        $spreadsheet = new Spreadsheet();

        $sheet = $spreadsheet->getActiveSheet();
        $sheet->setTitle('lofanje export');

        $entryList = $this->getEntryList($request);

        $headerRow = 1;
        foreach ($entryList as $category => $entries) {
            $columns = Entry::FIELDS[$category];

            // sets the category above the field columns in a seperate row
            $categoryCell = $sheet->getCell('A' . $headerRow);
            $categoryCell->setValue($category);
            $categoryCell->getStyle()->getFill()->setFillType(Fill::FILL_SOLID)->getStartColor()->setARGB('f5a40f');
            $categoryCell->getStyle()->getFont()->setBold(true);
            $headerRow+=1;

            foreach ($columns as $i => $column) {
                // sets the header for the category fields
                $cell = $sheet->getCell(strtoupper($this->getLetter($i) . $headerRow));
                $cell->setValue($column);
                $cell->getStyle()->getFill()->setFillType(Fill::FILL_SOLID)->getStartColor()->setARGB('f5a40f');
                $sheet->getColumnDimension(strtoupper($this->getLetter($i)))->setAutoSize(true);

                // sets the values beneath the created header for the category
                $columnIterator = $i++;
                foreach ($entries as $i2 => $entry) {
                    $value = $entry->{'get' . $column}();
                    $value = is_string($value) ? $value : '';
                    $sheet->getCell(strtoupper($this->getLetter($columnIterator) . ($headerRow + $i2 + 1)))->setValue($value);
                }
            }

            $headerRow += count($entries) + 2;
        }
        foreach (range('A', $sheet->getHighestColumn()) as $col) {
            $sheet->getColumnDimension($col)->setAutoSize(true);
        }

        $filename = 'lofanje_export.xlsx';
        try {
            $writer = new Xlsx($spreadsheet);
            $writer->save($filename);
            $content = file_get_contents($filename);
        } catch (\Exception $exception) {
            exit ($exception->getMessage());
        }

        header("Content-Disposition: attachment; filename=" . $filename);

        unlink($filename);
        exit($content);

    }

    private function getEntryList(Request $request): ?array {
        $allCategories = $request->get('all-categories');

        if ($allCategories === 'true') {
            $entries = $this->getDoctrine()->getRepository(Entry::class)->findBy(['view_status' => 5]);
        } else {
            $categories = $request->get('categories');
            if (!$categories) {
                throw new NotFoundHttpException();
            }
            $entries = $this->getDoctrine()->getRepository(Entry::class)->findBy(['category' => $categories]);
        }

        $entryList = [];
        foreach ($entries as $entry) {
            $entryList[$entry->getCategory()][] = $entry;
        }

        return $entryList;
    }

    private function getLetter($i): string {
        $letters = array_combine(range(1, 26), range('a', 'z'));

        return $letters[$i + 1];
    }

}
