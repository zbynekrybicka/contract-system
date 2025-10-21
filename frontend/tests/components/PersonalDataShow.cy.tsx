import { Provider } from 'react-redux'
import { store }  from '../../src/store'
import PersonalDataShow from '../../src/components/PersonalDataShow'


describe('PersonalDataShow.cy.tsx', () => {
  it('%testName%', () => {
    cy.mount(<Provider store={store}><PersonalDataShow /></Provider>)
  })
})