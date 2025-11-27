import type { JSX } from "react"
import { useGetSalesmanTreeQuery } from "../services/api/userApi";

export default function SubordinateTree() : JSX.Element
{

    const { data: salesmanList, isLoading: isSalesmanListLoading } = useGetSalesmanTreeQuery(null);


    /**
     * @param salesmen any[]
     * @returns JSX.Element
     */
    function tree(salesmen: any[]): JSX.Element 
    {
        return <ul>
            {salesmen.map(salesman => 
                <li key={salesman.id}>
                    {salesman.name}
                    {salesman.subordinates && tree(salesman.subordinates)}
                </li>
            )}
        </ul>
    }


    return <div>{isSalesmanListLoading ? "Loading..." : salesmanList && tree(salesmanList)}</div>
}