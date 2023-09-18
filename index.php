#! /usr/bin/env php

<?php

class Income
{
    /**
     * @param $amount
     * @param $category
     *
     * @return void
     */
    public function setIncome($amount, $category): void
    {
        $dataArray  = [
            "amount"   => $amount,
            "category" => $category
        ];
        $dataObject = (object) $dataArray;
        file_put_contents('incomes.txt', json_encode($dataObject)."\n", FILE_APPEND);
    }

    /**
     * @return int
     */
    public function getIncome(): int
    {
        $incomes     = file('incomes.txt');
        $totalIncome = 0;
        foreach ($incomes as $data) {
            $income = json_decode($data);
            if (isset($income->amount)) {
                $totalIncome += $income->amount;
            }
        }

        return $totalIncome;
    }

    /**
     * @return void
     */
    public function getCategories(): void
    {
        printf("\n");
        printf("Income Categories: \n");
        printf("-------------------------------- \n");
        $incomes = file('incomes.txt');
        foreach ($incomes as $key => $data) {
            $income = json_decode($data);
            if ( ! empty($income->category)) {
                echo "$key. {$income->category}\n";
            }
        }
    }
}

class Expense
{
    /**
     * @param $amount
     * @param $category
     *
     * @return void
     */
    public function setExpense($amount, $category): void
    {
        $dataArray  = [
            "amount"   => $amount,
            "category" => $category
        ];
        $dataObject = (object) $dataArray;
        file_put_contents('expenses.txt', json_encode($dataObject)."\n", FILE_APPEND);
    }

    /**
     * @return int
     */
    public function getExpense(): int
    {
        $expenses     = file('expenses.txt');
        $totalExpense = 0;
        foreach ($expenses as $data) {
            $expense = json_decode($data);
            if (isset($expense->amount)) {
                $totalExpense += $expense->amount;
            }
        }

        return $totalExpense;
    }

    /**
     * @return void
     */
    public function getCategories(): void
    {
        printf("\n");
        printf("Expense Categories: \n");
        printf("-------------------------------- \n");
        $expenses = file('expenses.txt');
        foreach ($expenses as $key => $data) {
            $expense = json_decode($data);
            if ( ! empty($expense->category)) {
                echo "$key. {$expense->category}\n";
            }
        }
    }
}


/**
 * @return void
 */
function info(): void
{
    printf("\n");
    printf("-------------------------------- \n");
    printf("What do you want to do? \n");
    printf(" 1. Add income \n");
    printf(" 2. Add expense \n");
    printf(" 3. View income \n");
    printf(" 4. View expense \n");
    printf(" 5. View total \n");
    printf(" 6. View categories \n");
    printf(" 7. exit \n");
    printf("-------------------------------- \n");
    printf("\n");
}

while (true) {
    $Income = new Income();
    $Expense = new Expense();
    info();
    $user_input = (int) readline("Enter a number: ");

    if ($user_input == 7) {
        echo "\n";
        printf("-------------------------------- \n");
        printf("Thanks You \n");
        printf("-------------------------------- \n");
        exit;
    } elseif ($user_input == 6) {
        $incomeCategories  = (string) $Income->getCategories();
        $expenseCategories = (string) $Expense->getCategories();
        printf($incomeCategories);
        printf($expenseCategories);
    } elseif ($user_input == 1) {
        echo "\n";
        $inputIncome    = (int) readline("Enter a Value: ");
        $incomeCategory = (string) readline("Enter a Category: ");
        if (empty($inputIncome)) {
            echo "\n";
            printf("-------------------------------- \n");
            printf("Invalid your income. \n");
            printf("-------------------------------- \n");
            echo "\n";
        } elseif (empty($incomeCategory)) {
            echo "\n";
            printf("-------------------------------- \n");
            printf("Invalid your category. \n");
            printf("-------------------------------- \n");
            echo "\n";
        } else {
            $Income->setIncome($inputIncome, $incomeCategory);
            echo "\n";
            printf("-------------------------------- \n");
            printf("Your Income Add Successfully. \n");
            printf("-------------------------------- \n");
            echo "\n";
        }
    } elseif ($user_input == 2) {
        echo "\n";
        $inputExpense    = (int) readline("Enter a Value: ");
        $expenseCategory = (string) readline("Enter a Category: ");
        if (empty($inputExpense)) {
            echo "\n";
            printf("-------------------------------- \n");
            printf("Invalid your expense. \n");
            printf("-------------------------------- \n");
            echo "\n";
        } elseif (empty($expenseCategory)) {
            echo "\n";
            printf("-------------------------------- \n");
            printf("Invalid your category. \n");
            printf("-------------------------------- \n");
            echo "\n";
        } else {
            $Expense->setExpense($inputExpense, $expenseCategory);
            echo "\n";
            printf("-------------------------------- \n");
            printf("Your Expense Add Successfully. \n");
            printf("-------------------------------- \n");
            echo "\n";
        }
    } elseif ($user_input == 3) {
        $income = (int) $Income->getIncome();
        echo "\n";
        printf("-------------------------------- \n");
        printf("Total Income: $income  \n");
        printf("-------------------------------- \n");
    } elseif ($user_input == 4) {
        $expense = (int) $Expense->getExpense();
        echo "\n";
        printf("-------------------------------- \n");
        printf("Total Expense: $expense  \n");
        printf("-------------------------------- \n");
    } elseif ($user_input == 5) {
        $income  = (int) $Income->getIncome();
        $expense = (int) $Expense->getExpense();
        $result  = $income - $expense;
        echo "\n";
        printf("-------------------------------- \n");
        printf("Total: $result  \n");
        printf("-------------------------------- \n");
    }else{
        echo "\n";
        printf("-------------------------------- \n");
        printf("Invalid Input \n");
        printf("-------------------------------- \n");
    }
}
