import { createSlice } from '@reduxjs/toolkit';
import type { Action, RootState } from '.';

export type NewContactFormData = {
    isShownForm: boolean;
    firstName: string;
    middleName: string;
    lastName: string;
    dialNumber: number;
    phoneNumber: string;
    email: string;
}

const slice = createSlice({
    name: "newContactForm",

    initialState: {
        isShownForm: false,
        firstName: "",
        middleName: "",
        lastName: "",
        dialNumber: 420,
        phoneNumber: "",
        email: ""
    },

    reducers: {
        /**
         * 
         * 
         * @param state NewContactFormData
         * @param action Action
         */
        showForm: (state: NewContactFormData, action: Action<boolean>) => {
            state.isShownForm = action.payload
        },


        /**
         * 
         * 
         * @param state NewContactFormData
         * @param action Action
         */
        setFirstName: (state: NewContactFormData, action: Action<string>) => {
            state.firstName = action.payload
        },


        /**
         * 
         * 
         * @param state NewContactFormData
         * @param action Action
         */
        setMiddleName: (state: NewContactFormData, action: Action<string>) => {
            state.middleName = action.payload
        },


        /**
         * 
         * @param state NewContactFormData
         * @param action Action
         */
        setLastName: (state: NewContactFormData, action: Action<string>) => {
            state.lastName = action.payload
        },


        /**
         * 
         * @param state NewContactFormData
         * @param action Action
         */
        setDialNumber: (state: NewContactFormData, action: Action<number>) => {
            state.dialNumber = action.payload
        },


        /**
         * 
         * @param state NewContactFormData
         * @param action Action
         */
        setPhoneNumber: (state: NewContactFormData, action: Action<string>) => {
            state.phoneNumber = action.payload
        },


        /**
         * 
         * @param state NewContactFormData
         * @param action Action
         */
        setEmail: (state: NewContactFormData, action: Action<string>) => {
            state.email = action.payload
        },


        
    }
})


/**
 * Is Shown Form
 * 
 * @param state RootState
 * @returns boolean
 */
export const isShownForm = (state: RootState): boolean => state.newContactForm.isShownForm

/**
 * First name
 * 
 * @param state RootState
 * @returns string
 */
export const getFirstName = (state: RootState): string => state.newContactForm.firstName


/**
 * Middle name
 * 
 * @param state RootState
 * @returns string
 */
export const getMiddleName = (state: RootState): string => state.newContactForm.middleName


/**
 * Last name
 * 
 * @param state RootState
 * @returns string
 */
export const getLastName = (state: RootState): string => state.newContactForm.lastName


/**
 * Dial number
 * 
 * @param state RootState
 * @returns number
 */
export const getDialNumber = (state: RootState): number => state.newContactForm.dialNumber


/**
 * Phone number
 * 
 * @param state RootState
 * @returns string
 */
export const getPhoneNumber = (state: RootState): string => state.newContactForm.phoneNumber


/**
 * Email
 * 
 * @param state RootState
 * @returns string
 */
export const getEmail = (state: RootState): string => state.newContactForm.email




export default slice.reducer
export const { showForm, setFirstName, setMiddleName, setLastName, setDialNumber, setPhoneNumber, setEmail } = slice.actions