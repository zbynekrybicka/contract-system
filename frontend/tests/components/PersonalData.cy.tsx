import { Provider } from 'react-redux'
import { store }  from '../../src/store'
import PersonalData from '../../src/components/PersonalData'


describe('PersonalData.cy.tsx', () => {
  it('%testName%', () => {
    cy.mount(<Provider store={store}><PersonalData /></Provider>)
  })
})