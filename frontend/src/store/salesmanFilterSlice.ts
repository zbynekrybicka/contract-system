import { createSlice } from '@reduxjs/toolkit';
import type { Action, RootState } from '.';

const slice = createSlice({
    name: 'salesmanFilter',
    initialState: { filteredSalesmanId: null as number | null },
    reducers: {

        /**
         * Set filtered salesman ID for filtering contacts
         * 
         * @param state { filteredSalesmanId: number | null }
         * @param action Action<number | null>
         */
        setFilteredSalesmanId: (state: { filteredSalesmanId: number | null }, action: Action<number | null>) => { 
            // console.log(action)
            state.filteredSalesmanId = action.payload
        },
    }
})

export const getFilteredSalesmanId = (state: RootState): number | null => state.salesmanFilter.filteredSalesmanId;
export const { setFilteredSalesmanId } = slice.actions;
export default slice.reducer;